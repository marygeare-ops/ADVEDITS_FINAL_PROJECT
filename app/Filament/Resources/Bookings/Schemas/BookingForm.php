<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer_name')
                    ->required(),
                TextInput::make('customer_email')
                    ->email()
                    ->required(),
                TextInput::make('customer_phone')
                    ->tel()
                    ->required(),
                TextInput::make('event_type')
                    ->required(),
                DatePicker::make('event_date')
                    ->required(),
                TimePicker::make('event_time')
                    ->required(),
                TimePicker::make('event_end_time')
                    ->required(),
                TextInput::make('service')
                    ->required(),
                TextInput::make('event_location')
                    ->required(),
                Textarea::make('message')
                    ->columnSpanFull(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('booking_status')
                    ->required()
                    ->default('pending'),
                TextInput::make('payment_status')
                    ->required()
                    ->default('pending'),
                DatePicker::make('rescheduled_date'),
                TimePicker::make('rescheduled_time'),
                Textarea::make('admin_notes')
                    ->columnSpanFull(),
            ]);
    }
}
