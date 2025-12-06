<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Filament\Widgets\UserCount;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Actions\Action;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->colors([
                'primary' => Color::Violet,
            ])
            ->brandName(config('app.name') . ' 系統管理後台')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                UserCount::class,
            ])
            ->middleware([
                'web'
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->userMenuItems([
                Action::make('admin')
                    ->label('使用者前台')
                    ->icon('heroicon-o-globe-alt')
                    ->url(fn() => route('filament.account.pages.dashboard'))
                    ->visible(fn() => (bool) auth()->user()->getRoleNames()->isNotEmpty()),

                Action::make('logout')
                    ->label('登出系統')
                    ->icon('heroicon-o-arrow-left-on-rectangle')
                    ->action(function () {
                        auth()->logout();
                        redirect('/');
                    }),
            ]);
    }
}
