<?php

namespace App\Filament\Pages;

use App\Models\PaymentSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManagePaymentSettings extends Page
{
    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedQrCode;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Payment Settings';

    protected static ?string $title = 'Payment Settings';

    protected string $view = 'filament.pages.manage-payment-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = PaymentSetting::query()->first();

        $this->form->fill([
            'gcash_qr_code' => $setting?->gcash_qr_code,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('GCash QR Code')
                    ->description('Upload the official GCash QR code that customers will use for their downpayment.')
                    ->schema([
                        FileUpload::make('gcash_qr_code')
                            ->label('GCash QR Code')
                            ->image()
                            ->disk('public')
                            ->directory('payment-settings')
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
        $data = $this->form->getState();

        $setting = PaymentSetting::query()->first();

        if (!$setting) {
            $setting = new PaymentSetting();
        }

        $setting->gcash_qr_code = $data['gcash_qr_code'];
        $setting->save();

        $this->form->fill([
            'gcash_qr_code' => $setting->gcash_qr_code,
        ]);

        Notification::make()
            ->title('GCash QR Code Saved Successfully')
            ->body('Your GCash QR code is now saved and available for customer checkout.')
            ->success()
            ->send();
    }
}
