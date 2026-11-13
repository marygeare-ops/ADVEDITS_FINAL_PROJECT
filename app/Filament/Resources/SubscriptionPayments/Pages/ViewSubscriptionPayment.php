<?php

namespace App\Filament\Resources\SubscriptionPayments\Pages;

use App\Filament\Resources\SubscriptionPayments\SubscriptionPaymentResource;
use App\Models\SubscriptionPayment;
use App\Services\SubscriptionService;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\DB;

class ViewSubscriptionPayment extends ViewRecord
{
    protected static string $resource = SubscriptionPaymentResource::class;

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Back to Subscription Payments')
                ->icon('heroicon-m-arrow-left')
                ->color('gray')
                ->url(SubscriptionPaymentResource::getUrl('index')),

            Action::make('approve')
                ->label('Approve Payment')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Approve Subscription Payment?')
                ->modalDescription('Confirm that you personally checked the GCash receipt and verified that the ₱1,000 payment was received.')
                ->visible(fn (): bool => auth()->user()?->isDeveloper() === true && $this->record->status === 'pending')
                ->action(function (): void {
                    DB::transaction(function (): void {
                        $payment = SubscriptionPayment::query()
                            ->lockForUpdate()
                            ->findOrFail($this->record->id);

                        if ($payment->status !== 'pending') {
                            throw new \RuntimeException('This payment has already been processed.');
                        }

                        if ((float) $payment->amount !== 1000.00) {
                            throw new \RuntimeException('The subscription payment must be exactly ₱1,000.');
                        }

                        $period = app(SubscriptionService::class)
                            ->nextSubscriptionPeriod($payment->user);

                        $payment->update([
                            'status' => 'approved',
                            'starts_at' => $period['starts_at'],
                            'expires_at' => $period['expires_at'],
                            'verified_at' => now(),
                            'verified_by' => auth()->id(),
                            'rejection_reason' => null,
                        ]);
                    });

                    Notification::make()
                        ->title('Subscription Payment Approved')
                        ->body('The Business Admin has been granted one month of subscription access.')
                        ->success()
                        ->send();

                    $this->redirect(
                        SubscriptionPaymentResource::getUrl('view', [
                            'record' => $this->record,
                        ])
                    );
                }),

            Action::make('reject')
                ->label('Reject Payment')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn (): bool => auth()->user()?->isDeveloper() === true && $this->record->status === 'pending')
                ->form([
                    Textarea::make('rejection_reason')
                        ->label('Reason for Rejection')
                        ->required()
                        ->maxLength(1000),
                ])
                ->requiresConfirmation()
                ->modalHeading('Reject Subscription Payment?')
                ->modalDescription('Provide a reason so the Business Admin knows why the payment was rejected.')
                ->action(function (array $data): void {
                    $payment = SubscriptionPayment::findOrFail($this->record->id);

                    if ($payment->status !== 'pending') {
                        Notification::make()
                            ->title('Payment Already Processed')
                            ->danger()
                            ->send();

                        return;
                    }

                    $payment->update([
                        'status' => 'rejected',
                        'verified_at' => now(),
                        'verified_by' => auth()->id(),
                        'rejection_reason' => $data['rejection_reason'],
                    ]);

                    Notification::make()
                        ->title('Subscription Payment Rejected')
                        ->body('The Business Admin may submit a new payment after reviewing the rejection reason.')
                        ->warning()
                        ->send();

                    $this->redirect(
                        SubscriptionPaymentResource::getUrl('view', [
                            'record' => $payment,
                        ])
                    );
                }),
        ];
    }
}
