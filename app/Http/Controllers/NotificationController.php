<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $customer = $request->user();

        $notifications = $customer->notifications()
            ->latest()
            ->get();

        $bookingIds = $notifications
            ->pluck('data.booking_id')
            ->filter()
            ->unique()
            ->values();

        $bookings = Booking::where('user_id', $customer->id)
            ->whereIn('id', $bookingIds)
            ->get()
            ->keyBy('id');

        $payments = Payment::whereIn('booking_id', $bookingIds)
            ->orderByDesc('id')
            ->get()
            ->unique('booking_id')
            ->keyBy('booking_id');

        $customer->unreadNotifications
            ->whereIn('id', $notifications->pluck('id'))
            ->markAsRead();

        return view('notifications', compact(
            'notifications',
            'bookings',
            'payments'
        ));
    }
}
