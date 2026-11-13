<?php

namespace App\Filament\Resources\Payments\Pages;

use App\Filament\Resources\Payments\PaymentResource;
use App\Notifications\BookingStatusNotification;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Payment;

class ViewPayment extends ViewRecord
{
    protected static string $resource = PaymentResource::class;

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Back to Payments')
                ->icon('heroicon-m-arrow-left')
                ->color('gray')
                ->url(PaymentResource::getUrl('index')),

            Action::make('verify')
                ->label('Verify Downpayment')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Verify GCash Downpayment')
                ->modalDescription('Confirm that you personally checked the GCash reference and receipt and verified that the payment was received.')
                ->visible(fn (): bool => $this->record->status === 'submitted')
                ->action(function (): void {
                    /** @var Payment $payment */
                    $payment = $this->record;
                    $booking = $payment->booking;

                    if (!$booking) {
                        Notification::make()
                            ->title('Booking not found')
                            ->danger()
                            ->send();

                        return;
                    }

                    $requiredDownpayment = round(
                        (float) $booking->total_amount * 0.50,
                        2
                    );

                    if ((float) $payment->total_amount < $requiredDownpayment) {
                        Notification::make()
                            ->title('Invalid Downpayment Amount')
                            ->body('The submitted payment is below the required 50% downpayment.')
                            ->danger()
                            ->send();

                        return;
                    }

                    $payment->update([
                        'status' => 'successful',
                        'paid_at' => now(),
                    ]);

                    $booking->update([
                        'payment_status' => 'partially_paid',
                    ]);

                    if ($booking->user) {
                        $booking->user->notify(
                            new BookingStatusNotification(
                                $booking,
                                'payment_verified'
                            )
                        );
                    }

                    Notification::make()
                        ->title('Downpayment Verified')
                        ->body(
                            'The 50% downpayment for Booking #' .
                            $booking->id .
                            ' has been verified successfully.'
                        )
                        ->success()
                        ->send();

                    $this->refreshFormData([
                        'status',
                        'paid_at',
                    ]);
                }),
        ];
    }
}
