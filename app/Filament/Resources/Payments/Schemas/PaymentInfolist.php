<?php

namespace App\Filament\Resources\Payments\Schemas;

use App\Models\Payment;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Information')
                    ->icon('heroicon-o-user')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('customer_name')
                            ->label('Customer Name')
                            ->weight('bold'),

                        TextEntry::make('customer_email')
                            ->label('Email Address'),
                    ]),

                Section::make('GCash Payment Details')
                    ->icon('heroicon-o-banknotes')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('booking_id')
                            ->label('Booking Reference')
                            ->formatStateUsing(fn ($state) => '#' . $state),

                        TextEntry::make('total_amount')
                            ->label('Downpayment Amount')
                            ->money('PHP')
                            ->weight('bold'),

                        TextEntry::make('gcash_reference')
                            ->label('GCash Reference Number')
                            ->copyable()
                            ->placeholder('Not submitted'),

                        TextEntry::make('submitted_at')
                            ->label('Date Submitted')
                            ->dateTime('M d, Y - h:i A')
                            ->placeholder('Not submitted'),

                        TextEntry::make('status')
                            ->label('Verification Status')
                            ->badge()
                            ->formatStateUsing(fn (?string $state): string => match ($state) {
                                'successful' => 'Downpayment Paid',
                                'submitted' => 'For Verification',
                                'pending' => 'Pending',
                                'failed' => 'Failed',
                                default => ucfirst($state ?? 'Unknown'),
                            })
                            ->color(fn (?string $state): string => match ($state) {
                                'successful' => 'success',
                                'submitted' => 'warning',
                                'pending' => 'gray',
                                'failed' => 'danger',
                                default => 'gray',
                            }),
                    ]),

                Section::make('Proof of Payment')
                    ->description('Review the customer-submitted GCash receipt before verifying the payment.')
                    ->icon('heroicon-o-receipt-percent')
                    ->columnSpanFull()
                    ->schema([
                        ImageEntry::make('payment_proof')
                            ->label('Uploaded Receipt')
                            ->disk('public')
                            ->imageHeight('550px')
                            ->imageWidth('100%')
                            ->checkFileExistence()
                            ->placeholder('No payment proof uploaded'),
                    ]),

                Section::make('Verification Information')
                    ->icon('heroicon-o-shield-check')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('paid_at')
                            ->label('Date Verified')
                            ->dateTime('M d, Y - h:i A')
                            ->placeholder('Not yet verified'),

                        TextEntry::make('transaction_reference')
                            ->label('System Transaction Reference')
                            ->placeholder('Not available'),
                    ]),
            ]);
    }
}
