<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\PaymentSetting;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => ['required', 'integer'],
        ]);

        $booking = Booking::where('user_id', $request->user()->id)
            ->where('booking_status', 'accepted')
            ->findOrFail($validated['booking_id']);

        if (in_array($booking->payment_status, ['partially_paid', 'paid'])) {
            return redirect()
                ->route('notifications.index')
                ->with('error', 'Your downpayment has already been recorded.');
        }

        $successfulPayment = Payment::where('booking_id', $booking->id)
            ->where('status', 'successful')
            ->exists();

        if ($successfulPayment) {
            return redirect()
                ->route('notifications.index')
                ->with('error', 'A successful payment already exists for this booking.');
        }

        $downpayment = round((float) $booking->total_amount * 0.50, 2);

        $payment = Payment::where('booking_id', $booking->id)
            ->whereIn('status', ['pending', 'submitted'])
            ->latest()
            ->first();

        if ($payment && $payment->payment_proof) {
            return redirect()
                ->route('notifications.index')
                ->with('success', 'Your payment proof is already submitted and awaiting verification.');
        }

        if ($payment) {
            $payment->update([
                'customer_name' => $booking->customer_name,
                'customer_email' => $booking->customer_email,
                'total_amount' => $downpayment,
                'developer_commission' => 0,
                'adv_edits_share' => $downpayment,
            ]);
        } else {
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'customer_name' => $booking->customer_name,
                'customer_email' => $booking->customer_email,
                'total_amount' => $downpayment,
                'developer_commission' => 0,
                'adv_edits_share' => $downpayment,
                'payment_method' => 'gcash',
                'transaction_reference' => 'ADV-' . strtoupper(Str::random(10)),
                'status' => 'pending',
            ]);
        }

        $paymentSetting = PaymentSetting::first();

        return view('payment-checkout', compact(
            'payment',
            'booking',
            'paymentSetting'
        ));
    }

    public function submitProof(Request $request, Payment $payment)
    {
        $booking = Booking::where('user_id', $request->user()->id)
            ->findOrFail($payment->booking_id);

        if ($payment->status !== 'pending' || $payment->payment_proof) {
            return redirect()
                ->route('notifications.index')
                ->with('error', 'This payment proof has already been submitted or processed.');
        }

        $validated = $request->validate([
            'gcash_reference' => ['required', 'string', 'max:255'],
            'payment_proof' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $proofPath = $request->file('payment_proof')
            ->store('payment-proofs', 'public');

        $payment->update([
            'gcash_reference' => $validated['gcash_reference'],
            'payment_proof' => $proofPath,
            'submitted_at' => now(),
            'status' => 'submitted',
        ]);

        User::query()
            ->where('is_admin', true)
            ->each(function (User $admin) use ($payment, $booking) {
                Notification::make()
                    ->title('Payment Proof Submitted')
                    ->body(
                        $payment->customer_name .
                        ' submitted a GCash payment proof of ₱' .
                        number_format((float) $payment->total_amount, 2) .
                        ' for Booking #' .
                        $booking->id .
                        '. GCash Reference: ' .
                        $payment->gcash_reference .
                        '. Please verify the payment.'
                    )
                    ->icon('heroicon-o-banknotes')
                    ->warning()
                    ->sendToDatabase($admin);
            });

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Your payment proof has been submitted. Please wait for admin verification.');
    }

    public function cancel(Request $request, Payment $payment)
    {
        Booking::where('user_id', $request->user()->id)
            ->findOrFail($payment->booking_id);

        if ($payment->status === 'pending' && !$payment->payment_proof) {
            $payment->update([
                'status' => 'failed',
            ]);
        }

        return redirect()
            ->route('notifications.index')
            ->with('error', 'Your payment was cancelled.');
    }
}
