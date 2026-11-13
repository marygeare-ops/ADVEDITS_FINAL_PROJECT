<?php

namespace App\Filament\Resources\SubscriptionPayments\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SubscriptionPaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Business Admin Information')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->schema([
                    TextEntry::make('user.name')
                        ->label('Admin Name')
                        ->weight('bold'),

                    TextEntry::make('user.email')
                        ->label('Email Address'),
                ]),

            Section::make('Subscription Payment Details')
                ->icon('heroicon-o-banknotes')
                ->columns(2)
                ->schema([
                    TextEntry::make('amount')
                        ->label('Subscription Amount')
                        ->money('PHP')
                        ->weight('bold'),

                    TextEntry::make('gcash_reference')
                        ->label('GCash Reference Number')
                        ->copyable(),

                    TextEntry::make('status')
                        ->label('Payment Status')
                        ->badge()
                        ->formatStateUsing(fn (?string $state): string => match ($state) {
                            'pending' => 'For Verification',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected',
                            default => ucfirst($state ?? 'Unknown'),
                        })
                        ->color(fn (?string $state): string => match ($state) {
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            default => 'gray',
                        }),

                    TextEntry::make('submitted_at')
                        ->label('Date Submitted')
                        ->dateTime('M d, Y - h:i A'),

                    TextEntry::make('starts_at')
                        ->label('Subscription Starts')
                        ->dateTime('M d, Y - h:i A')
                        ->placeholder('Not activated'),

                    TextEntry::make('expires_at')
                        ->label('Subscription Expires')
                        ->dateTime('M d, Y - h:i A')
                        ->placeholder('Not activated'),
                ]),

            Section::make('Uploaded Proof of Payment')
                ->icon('heroicon-o-photo')
                ->columnSpanFull()
                ->schema([
                    ImageEntry::make('payment_proof')
                        ->label('GCash Receipt')
                        ->disk('public')
                        ->imageHeight('550px')
                        ->imageWidth('100%')
                        ->checkFileExistence()
                        ->placeholder('No receipt uploaded'),
                ]),

            Section::make('Verification Information')
                ->icon('heroicon-o-shield-check')
                ->columns(2)
                ->schema([
                    TextEntry::make('verifier.name')
                        ->label('Verified By')
                        ->placeholder('Not yet verified'),

                    TextEntry::make('verified_at')
                        ->label('Date Verified')
                        ->dateTime('M d, Y - h:i A')
                        ->placeholder('Not yet verified'),

                    TextEntry::make('rejection_reason')
                        ->label('Rejection Reason')
                        ->placeholder('No rejection reason')
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
