<?php

namespace App\Filament\Account\Resources\Bots\Pages;

use App\Filament\Account\Resources\Bots\BotResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditBot extends EditRecord
{
    protected static string $resource = BotResource::class;

    protected static ?string $title = '編輯交易機器人';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('stop')
                ->label('停止機器人')
                ->icon('heroicon-o-stop')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('停止機器人')
                ->modalDescription('⚠️ 停止後將永久停用此機器人，系統不會再執行任何交易，且無法重新啟動。若未來需要再次使用，請重新建立新的機器人。')
                ->modalSubmitActionLabel('確定停止')
                ->disabled(fn() => $this->record?->status === 'STOPPED')
                ->action(function () {
                    $this->record->update([
                        'status' => 'STOPPED',
                        'stopped_at' => now(),
                    ]);

                    Notification::make()
                        ->title('已停止機器人')
                        ->success()
                        ->send();

                    return redirect(
                        static::$resource::getUrl('index')
                    );
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getBreadcrumbs(): array
    {
        return [
            route('filament.account.resources.bots.index') => '交易機器人',
            $this->record->name ?? '交易機器人',
            '編輯',
        ];
    }
}
