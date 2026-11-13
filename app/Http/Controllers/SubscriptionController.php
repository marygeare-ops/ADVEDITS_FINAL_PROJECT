<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPayment;
use App\Models\SubscriptionSetting;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SubscriptionController extends Controller
{
    public function index(Request $request, SubscriptionService $subscriptionService)
    {
        $user = $request->user();

        abort_unless($user->isBusinessAdmin(), 403);

        $latestPayment = $user->subscriptionPayments()
            ->latest()
            ->first();

        $activeSubscription = $subscriptionService->activeSubscription($user);

        $setting = SubscriptionSetting::query()->first();

        $gcashQrUrl = $setting?->gcash_qr_code
            ? Storage::disk('public')->url($setting->gcash_qr_code)
            : null;

        return view('subscription.renewal', compact(
            'latestPayment',
            'activeSubscription',
            'gcashQrUrl'
        ));
    }

    public function submit(Request $request)
    {
        $user = $request->user();

        abort_unless($user->isBusinessAdmin(), 403);

        $existingPendingPayment = $user->subscriptionPayments()
            ->where('status', 'pending')
            ->exists();

        if ($existingPendingPayment) {
            return back()->with(
                'error',
                'You already have a subscription payment awaiting verification.'
            );
        }

        $validated = $request->validate([
            'gcash_reference' => ['required', 'string', 'max:100'],
            'payment_proof' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $proofPath = $request->file('payment_proof')
            ->store('subscription-proofs', 'public');

        $user->subscriptionPayments()->create([
            'amount' => 1000.00,
            'gcash_reference' => $validated['gcash_reference'],
            'payment_proof' => $proofPath,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        return redirect()
            ->route('subscription.renewal')
            ->with(
                'success',
                'Your subscription payment has been submitted. Please wait for developer verification.'
            );
    }

    public function cancel(Request $request)
    {
        $user = $request->user();

        abort_unless($user->isBusinessAdmin(), 403);

        $cancelled = DB::transaction(function () use ($user) {
            $activePayment = SubscriptionPayment::query()
                ->where('user_id', $user->id)
                ->where('status', 'approved')
                ->whereNotNull('expires_at')
                ->where('expires_at', '>', now())
                ->latest('expires_at')
                ->lockForUpdate()
                ->first();

            if (!$activePayment) {
                return false;
            }

            $activePayment->update([
                'status' => 'cancelled',
            ]);

            return true;
        });

        if (!$cancelled) {
            return back()->with(
                'error',
                'There is no active subscription to cancel.'
            );
        }

        return redirect()
            ->route('subscription.renewal')
            ->with(
                'success',
                'Your subscription has been cancelled. Admin panel access has been disabled.'
            );
    }
}
