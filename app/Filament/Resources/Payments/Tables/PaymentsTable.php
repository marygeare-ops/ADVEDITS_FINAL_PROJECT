<?php

namespace App\Filament\Resources\Payments\Tables;

use App\Filament\Resources\Payments\PaymentResource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('gcash_reference')
                    ->label('GCash Reference')
                    ->searchable()
                    ->copyable()
                    ->placeholder('Not submitted'),

                TextColumn::make('status')
                    ->label('Payment Status')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'submitted' => 'For Verification',
                        'successful' => 'Downpayment Paid',
                        'pending' => 'Pending',
                        'failed' => 'Failed',
                        default => ucfirst($state ?? 'Unknown'),
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'submitted' => 'warning',
                        'successful' => 'success',
                        'pending' => 'gray',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->recordUrl(
                fn ($record): string => PaymentResource::getUrl('view', [
                    'record' => $record,
                ])
            )
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated(false);
    }
}
