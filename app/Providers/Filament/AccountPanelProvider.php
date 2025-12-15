<?php

namespace App\Providers\Filament;

use App\Filament\Account\Pages\Dashboard;
use App\Filament\Account\Widgets\ActiveBots;
use App\Http\Middleware\Authenticate;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Actions\Action;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;

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
                Action::make('copyUid')
                    ->label(fn() => 'UID: ' . auth()->user()->uid)
                    ->icon('heroicon-o-clipboard-document')
                    ->action(function ($livewire) {
                        $uid = auth()->user()->uid;
                        $livewire->dispatch('copy-to-clipboard', $uid);
                    }),

                Action::make('subscription-plan')
                    ->label(fn() => '目前方案：' . (auth()->user()->subscription_plan ?? '免費'))
                    ->icon('heroicon-o-credit-card')
                    ->disabled()
                    ->color('gray'),

                Action::make('subscription-plan-ends')
                    ->visible(fn() => auth()->user()->subscription_ends_at ?? false)
                    ->label(fn() => '到期日：' . date('Y-m-d', strtotime(auth()->user()->subscription_ends_at)))
                    ->icon('heroicon-o-calendar-days')
                    ->disabled()
                    ->color('gray'),

                Action::make('admin')
                    ->label('系統管理後台')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url(fn() => route('filament.admin.pages.dashboard'))
                    ->visible(fn() => (bool) auth()->user()->getRoleNames()->isNotEmpty()),

                Action::make('logout')
                    ->label('登出')
                    ->icon('heroicon-o-arrow-left-on-rectangle')
                    ->action(function () {
                        auth()->logout();
                        redirect('/');
                    }),
            ]);
    }

    public function boot(): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::SCRIPTS_AFTER,
            fn(): string => Blade::render(<<<'BLADE'
                <script>
                    document.addEventListener('livewire:initialized', () => {
                        Livewire.on('copy-to-clipboard', (event) => {
                            navigator.clipboard.writeText(event).then(() => {
                                // Optional: Show a notification (Filament uses their own notification system)
                                console.log('Copied to clipboard:', event);
                                if (window.$tooltip) {
                                    window.$tooltip('UID 已複製', { timeout: 1500 });
                                }
                            }).catch(err => {
                                console.error('Could not copy text: ', err);
                            });
                        });
                    });
                </script>
            BLADE),
        );
    }
}
