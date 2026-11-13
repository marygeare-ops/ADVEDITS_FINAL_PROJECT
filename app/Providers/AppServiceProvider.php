<?php
namespace App\Providers;

use Filament\Support\Facades\FilamentIcon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentIcon::register([
            // Topbar sidebar toggle
            'panels::topbar.open-sidebar-button' => 'heroicon-o-bars-3',
            'panels::topbar.close-sidebar-button' => 'heroicon-o-bars-3',

            // Desktop sidebar collapse / expand toggle
            'panels::sidebar.collapse-button' => 'heroicon-o-bars-3',
            'panels::sidebar.expand-button' => 'heroicon-o-bars-3',
            'panels::sidebar.collapse-button.rtl' => 'heroicon-o-bars-3',
            'panels::sidebar.expand-button.rtl' => 'heroicon-o-bars-3',
        ]);
    }
}
