<?php

namespace App\Providers\Filament;

use App\Filament\Account\Pages\Dashboard;
use App\Filament\Account\Widgets\ActiveBots;
use App\Http\Middleware\Authenticate;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Actions\Action;

class AccountPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('account')
            ->path('account')
            ->favicon(asset('favicon.svg'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Account/Resources'), for: 'App\Filament\Account\Resources')
            ->discoverPages(in: app_path('Filament/Account/Pages'), for: 'App\Filament\Account\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Account/Widgets'), for: 'App\Filament\Account\Widgets')
            ->widgets([
                ActiveBots::class,
            ])
            ->middleware([
                'web'
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->userMenuItems([
                Action::make('admin')
                    ->label('系統管理後台')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url(fn() => route('filament.admin.pages.dashboard'))
                    ->visible(fn() => (bool) auth()->user()?->is_admin),
            ]);
    }
}
