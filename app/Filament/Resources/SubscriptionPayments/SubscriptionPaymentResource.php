<?php

namespace App\Filament\Resources\SubscriptionPayments;

use App\Filament\Resources\SubscriptionPayments\Pages\ListSubscriptionPayments;
use App\Filament\Resources\SubscriptionPayments\Pages\ViewSubscriptionPayment;
use App\Filament\Resources\SubscriptionPayments\Schemas\SubscriptionPaymentInfolist;
use App\Filament\Resources\SubscriptionPayments\Tables\SubscriptionPaymentsTable;
use App\Models\SubscriptionPayment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubscriptionPaymentResource extends Resource
{
    protected static ?string $model = SubscriptionPayment::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedReceiptPercent;

    protected static ?string $navigationLabel = 'Subscription Payments';

    protected static ?string $modelLabel = 'Subscription Payment';

    protected static ?string $pluralModelLabel = 'Subscription Payments';

    protected static ?string $recordTitleAttribute = 'gcash_reference';

    public static function canAccess(): bool
    {
        return auth()->user()?->isDeveloper() === true;
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubscriptionPaymentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubscriptionPaymentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubscriptionPayments::route('/'),
            'view' => ViewSubscriptionPayment::route('/{record}'),
        ];
    }
}
