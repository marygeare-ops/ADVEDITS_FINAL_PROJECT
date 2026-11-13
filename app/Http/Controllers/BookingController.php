<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use App\Notifications\BookingStatusNotification;
use Filament\Notifications\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $selectedServiceId = $request->query('service_id');

        $selectedService = $selectedServiceId
            ? $services->firstWhere('id', (int) $selectedServiceId)
            : null;

        return view('booking', compact(
            'services',
            'selectedService'
        ));
    }

    public function availability(): JsonResponse
    {
        $bookings = Booking::query()
            ->whereIn('booking_status', [
                'pending',
                'accepted',
                'rescheduled',
            ])
            ->get();

        $events = $bookings->map(function ($booking) {
            $date = $booking->event_date->format('Y-m-d');

            return [
                'title' => 'Unavailable',
                'start' => $date . 'T' . substr((string) $booking->event_time, 0, 8),
                'end' => $date . 'T' . substr((string) $booking->event_end_time, 0, 8),
                'allDay' => false,
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_phone' => ['required', 'string', 'max:30'],
            'service_id' => [
                'required',
                'integer',
                Rule::exists('services', 'id')->where('is_active', true),
            ],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
            'event_time' => ['required', 'date_format:H:i'],
            'event_end_time' => [
                'required',
                'date_format:H:i',
                'after:event_time',
            ],
            'event_location' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
        ]);

        $hasConflict = Booking::query()
            ->whereDate('event_date', $validated['event_date'])
            ->whereIn('booking_status', [
                'pending',
                'accepted',
                'rescheduled',
            ])
            ->where('event_time', '<', $validated['event_end_time'])
            ->where('event_end_time', '>', $validated['event_time'])
            ->exists();

        if ($hasConflict) {
            throw ValidationException::withMessages([
                'event_time' => 'This schedule is already booked. Please choose another date or time.',
            ]);
        }

        $customer = $request->user();

        $service = Service::query()
            ->where('is_active', true)
            ->findOrFail($validated['service_id']);

        $booking = Booking::create([
            'user_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'customer_phone' => $validated['customer_phone'],
            'event_type' => $service->event_type,
            'event_date' => $validated['event_date'],
            'event_time' => $validated['event_time'],
            'event_end_time' => $validated['event_end_time'],
            'service_id' => $service->id,
            'service' => $service->name,
            'service_name_snapshot' => $service->name,
            'event_location' => $validated['event_location'],
            'message' => $validated['message'] ?? null,
            'total_amount' => $service->price,
            'booking_status' => 'pending',
            'payment_status' => 'pending',
        ]);

        $customer->notify(
            new BookingStatusNotification($booking, 'pending')
        );

        User::query()
            ->where('is_admin', true)
            ->each(function (User $admin) use ($booking) {
                Notification::make()
                    ->title('New Booking Request')
                    ->body(
                        $booking->customer_name .
                        ' submitted a booking for ' .
                        $booking->service_name_snapshot .
                        ' on ' .
                        $booking->event_date->format('F d, Y') .
                        ' at ' .
                        date('h:i A', strtotime($booking->event_time)) .
                        '.'
                    )
                    ->icon('heroicon-o-calendar-days')
                    ->warning()
                    ->sendToDatabase($admin);
            });

        return redirect()
            ->route('booking.index')
            ->with('success', 'Your booking request has been submitted successfully!');
    }
}
