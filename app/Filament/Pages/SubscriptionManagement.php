<?php

namespace App\Filament\Pages;

use BackedEnum;
use UnitEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class SubscriptionManagement extends Page
{
    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected static string | UnitEnum | null $navigationGroup = 'Account';

    protected static ?string $navigationLabel = 'Subscription Management';

    protected static ?string $title = 'Subscription Management';

    protected string $view = 'filament.pages.subscription-management';

    public static function canAccess(): bool
    {
        return auth()->user()?->isBusinessAdmin() === true;
    }
}
