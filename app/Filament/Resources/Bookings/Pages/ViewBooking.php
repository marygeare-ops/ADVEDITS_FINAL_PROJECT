<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use App\Notifications\BookingStatusNotification;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Back to Bookings')
                ->icon('heroicon-m-arrow-left')
                ->color('gray')
                ->url(BookingResource::getUrl('index')),

            Action::make('accept')
                ->label('Accept Booking')
                ->color('success')
                ->icon('heroicon-m-check-circle')
                ->requiresConfirmation()
                ->modalHeading('Accept this booking?')
                ->modalDescription('This will approve the customer booking. Payment will remain pending until the customer completes checkout.')
                ->visible(fn () => $this->record->booking_status === 'pending')
                ->action(function () {
                    $this->record->update([
                        'booking_status' => 'accepted',
                    ]);

                    $this->record->user?->notify(
                        new BookingStatusNotification(
                            $this->record,
                            'accepted'
                        )
                    );

                    Notification::make()
                        ->title('Booking accepted successfully')
                        ->success()
                        ->send();
                }),

            Action::make('reject')
                ->label('Reject Booking')
                ->color('danger')
                ->icon('heroicon-m-x-circle')
                ->requiresConfirmation()
                ->modalHeading('Reject this booking?')
                ->modalDescription('Are you sure you want to reject this customer booking?')
                ->visible(fn () => $this->record->booking_status === 'pending')
                ->action(function () {
                    $this->record->update([
                        'booking_status' => 'rejected',
                    ]);

                    $this->record->user?->notify(
                        new BookingStatusNotification(
                            $this->record,
                            'rejected'
                        )
                    );

                    Notification::make()
                        ->title('Booking rejected')
                        ->success()
                        ->send();
                }),
        ];
    }
}
