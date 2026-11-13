<?php
namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use App\Models\Booking;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected string $view = 'filament.resources.bookings.pages.list-bookings';

    public bool $showCalendar = false;

    public function getBreadcrumbs(): array
    {
        return [];
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable|null
    {
        return null;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function toggleCalendar(): void
    {
        $this->showCalendar = ! $this->showCalendar;
    }

    public function getCalendarBookings(): array
    {
        return Booking::query()
            ->where('booking_status', 'accepted')
            ->whereNotNull('event_date')
            ->get()
            ->map(function (Booking $booking) {
                return [
                    'id' => $booking->id,
                    'title' => $booking->customer_name . ' - ' . $booking->event_type,
                    'start' => $booking->event_date->format('Y-m-d')
                        . ($booking->event_time
                            ? 'T' . $booking->event_time
                            : ''),
                    'allDay' => ! $booking->event_time,
                    'color' => '#16a34a',
                ];
            })
            ->values()
            ->all();
    }
}
