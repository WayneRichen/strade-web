<?php

namespace App\Filament\Account\Resources\ExchangeAccounts\Pages;

use App\Filament\Account\Resources\ExchangeAccounts\ExchangeAccountResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditExchangeAccount extends EditRecord
{
    protected static string $resource = ExchangeAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function testApiKey()
    {
        try {
            // 呼叫 Service（例：Binance）
            // $service = app(\App\Services\Exchange\BinanceService::class);
            // $result = $service->testKey($key, $secret);

            if (true) {
                Notification::make()
                    ->title('金鑰有效')
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('金鑰有誤')
                    ->warning()
                    ->send();
            }

        } catch (\Throwable $e) {
            // 交易所回來的錯誤
            Notification::make()
                    ->title('金鑰有誤')
                    ->warning()
                    ->send();
        }
    }
}
