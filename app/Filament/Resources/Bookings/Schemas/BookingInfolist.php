<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Booking;
use App\Models\Payment;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Information')
                    ->description('Customer contact details')
                    ->icon('heroicon-o-user')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('customer_name')
                            ->label('Customer Name')
                            ->weight('bold'),

                        TextEntry::make('customer_email')
                            ->label('Email Address'),

                        TextEntry::make('customer_phone')
                            ->label('Contact Number'),
                    ]),

                Section::make('Event Details')
                    ->description('Information about the requested event')
                    ->icon('heroicon-o-calendar-days')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('event_type')
                            ->label('Event Type')
                            ->weight('bold'),

                        TextEntry::make('service')
                            ->label('Selected Service'),

                        TextEntry::make('event_date')
                            ->label('Event Date')
                            ->date('F d, Y'),

                        TextEntry::make('event_time')
                            ->label('Start Time')
                            ->time('h:i A'),

                        TextEntry::make('event_end_time')
                            ->label('End Time')
                            ->time('h:i A'),

                        TextEntry::make('event_location')
                            ->label('Event Location')
                            ->columnSpanFull(),

                        TextEntry::make('message')
                            ->label('Customer Message')
                            ->placeholder('No additional message')
                            ->columnSpanFull(),
                    ]),

                Section::make('Booking Summary')
                    ->description('Booking amount and reservation status')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('booking_status')
                            ->label('Booking Status')
                            ->badge()
                            ->formatStateUsing(fn (?string $state): string => match ($state) {
                                'accepted' => 'Accepted',
                                'rejected' => 'Rejected',
                                'pending' => 'Pending',
                                default => ucfirst($state ?? 'Unknown'),
                            })
                            ->color(fn (?string $state): string => match ($state) {
                                'accepted' => 'success',
                                'rejected' => 'danger',
                                'pending' => 'warning',
                                default => 'gray',
                            }),

                        TextEntry::make('total_amount')
                            ->label('Total Booking Price')
                            ->money('PHP')
                            ->weight('bold'),
                    ]),

                Section::make('Downpayment Information')
                    ->description('50% downpayment and admin verification status')
                    ->icon('heroicon-o-banknotes')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('downpayment_amount')
                            ->label('Required Downpayment')
                            ->state(fn (Booking $record): float =>
                                round((float) $record->total_amount * 0.50, 2)
                            )
                            ->money('PHP')
                            ->weight('bold'),

                        TextEntry::make('payment_verification')
                            ->label('Payment Status')
                            ->state(function (Booking $record): string {
                                $requiredDownpayment = round(
                                    (float) $record->total_amount * 0.50,
                                    2
                                );

                                $verifiedAmount = Payment::where('booking_id', $record->id)
                                    ->where('status', 'successful')
                                    ->sum('total_amount');

                                return (float) $verifiedAmount >= $requiredDownpayment
                                    ? 'Downpayment Paid'
                                    : 'Unpaid';
                            })
                            ->badge()
                            ->color(fn (string $state): string =>
                                $state === 'Downpayment Paid' ? 'success' : 'warning'
                            ),

                        TextEntry::make('verified_amount')
                            ->label('Verified Amount')
                            ->state(fn (Booking $record): float =>
                                (float) Payment::where('booking_id', $record->id)
                                    ->where('status', 'successful')
                                    ->sum('total_amount')
                            )
                            ->money('PHP'),

                        TextEntry::make('remaining_balance')
                            ->label('Remaining Balance')
                            ->state(fn (Booking $record): float =>
                                max(
                                    0,
                                    (float) $record->total_amount -
                                    (float) Payment::where('booking_id', $record->id)
                                        ->where('status', 'successful')
                                        ->sum('total_amount')
                                )
                            )
                            ->money('PHP'),

                        TextEntry::make('verified_reference')
                            ->label('Verified GCash Reference')
                            ->state(fn (Booking $record): ?string =>
                                Payment::where('booking_id', $record->id)
                                    ->where('status', 'successful')
                                    ->latest('paid_at')
                                    ->value('gcash_reference')
                            )
                            ->placeholder('No verified payment')
                            ->columnSpanFull(),

                        TextEntry::make('verified_paid_at')
                            ->label('Date Verified')
                            ->state(fn (Booking $record) =>
                                Payment::where('booking_id', $record->id)
                                    ->where('status', 'successful')
                                    ->latest('paid_at')
                                    ->value('paid_at')
                            )
                            ->dateTime('M d, Y - h:i A')
                            ->placeholder('Not yet verified'),
                    ]),

                Section::make('Record Information')
                    ->description('Booking submission details')
                    ->icon('heroicon-o-document-text')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Date Submitted')
                            ->dateTime('M d, Y - h:i A'),

                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime('M d, Y - h:i A'),
                    ]),
            ]);
    }
}
