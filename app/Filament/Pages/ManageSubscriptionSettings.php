<?php

namespace App\Filament\Pages;

use App\Models\SubscriptionSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageSubscriptionSettings extends Page
{
    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedQrCode;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Subscription Settings';

    protected static ?string $title = 'Subscription Settings';

    protected string $view = 'filament.pages.manage-subscription-settings';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->isDeveloper() === true;
    }

    public function mount(): void
    {
        abort_unless(auth()->user()?->isDeveloper() === true, 403);

        $setting = SubscriptionSetting::query()->first();

        $this->form->fill([
            'gcash_qr_code' => $setting?->gcash_qr_code,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Developer GCash QR Code')
                    ->description('Upload the official GCash QR code used for the ₱1,000 monthly ADV-EDITS subscription.')
                    ->schema([
                        FileUpload::make('gcash_qr_code')
                            ->label('Subscription GCash QR Code')
                            ->image()
                            ->disk('public')
                            ->directory('subscription-settings')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(2048)
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        abort_unless(auth()->user()?->isDeveloper() === true, 403);

        $data = $this->form->getState();

        $setting = SubscriptionSetting::query()->first();

        if (!$setting) {
            $setting = new SubscriptionSetting();
        }

        $setting->gcash_qr_code = $data['gcash_qr_code'];
        $setting->save();

        $this->form->fill([
            'gcash_qr_code' => $setting->gcash_qr_code,
        ]);

        Notification::make()
            ->title('Subscription GCash QR Saved')
            ->body('The Developer GCash QR code is now available for subscription payments.')
            ->success()
            ->send();
    }
}
