<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookingsTable
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

                TextColumn::make('event_type')
                    ->label('Event')
                    ->sortable(),

                TextColumn::make('event_date')
                    ->label('Date & Time')
                    ->date('M d, Y')
                    ->description(fn ($record) =>
                        $record->event_time
                            ? \Illuminate\Support\Carbon::parse($record->event_time)->format('g:i A')
                            : 'Time not set'
                    )
                    ->sortable(),

                TextColumn::make('booking_status')
                    ->label('Booking Status')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'accepted' => 'Accepted',
                        'pending' => 'Pending',
                        'rejected' => 'Rejected',
                        default => ucfirst($state ?? 'Unknown'),
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'accepted' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
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
