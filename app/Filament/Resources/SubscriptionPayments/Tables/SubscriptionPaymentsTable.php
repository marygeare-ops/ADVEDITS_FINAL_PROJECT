<?php

namespace App\Filament\Resources\SubscriptionPayments\Tables;

use App\Filament\Resources\SubscriptionPayments\SubscriptionPaymentResource;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubscriptionPaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Business Admin')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('gcash_reference')
                    ->label('GCash Reference')
                    ->searchable()
                    ->placeholder('Not available'),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('PHP'),

                TextColumn::make('status')
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

                TextColumn::make('submitted_at')
                    ->label('Date Submitted')
                    ->dateTime('M d, Y - h:i A')
                    ->sortable(),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('View Details')
                    ->icon('heroicon-o-eye')
                    ->color('gray'),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated(false);
    }
}
