<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingStatusNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Booking $booking,
        public string $status,
        public ?string $adminMessage = null
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $downpayment = round((float) $this->booking->total_amount * 0.50, 2);

        $title = match ($this->status) {
            'pending' => 'Booking Submitted',
            'accepted' => 'Booking Accepted!',
            'rejected' => 'Booking Rejected',
            'payment_verified' => 'Downpayment Verified!',
            default => 'Booking Update',
        };

        $message = match ($this->status) {
            'pending' => 'Your booking has been submitted successfully. Please wait for admin approval.',
            'accepted' => 'Great news! Your booking has been accepted. Please pay your 50% downpayment to confirm your reservation.',
            'rejected' => 'Unfortunately, your booking has been rejected.',
            'payment_verified' => 'Your 50% GCash downpayment has been verified successfully. Your booking is now partially paid.',
            default => 'Your booking status has been updated.',
        };

        return [
            'booking_id' => $this->booking->id,
            'status' => $this->status,
            'title' => $title,
            'message' => $message,
            'admin_message' => $this->adminMessage,
            'downpayment_amount' => in_array($this->status, ['accepted', 'payment_verified'])
                ? $downpayment
                : null,
            'total_amount' => (float) $this->booking->total_amount,
            'service_name' => $this->booking->service_name_snapshot
                ?? $this->booking->service,
            'event_date' => $this->booking->event_date?->format('Y-m-d'),
            'created_at' => now()->toDateTimeString(),
        ];
    }
}
