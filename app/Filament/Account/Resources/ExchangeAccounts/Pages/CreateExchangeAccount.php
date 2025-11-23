<?php

namespace App\Filament\Account\Resources\ExchangeAccounts\Pages;

use App\Filament\Account\Resources\ExchangeAccounts\ExchangeAccountResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateExchangeAccount extends CreateRecord
{
    protected static string $resource = ExchangeAccountResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
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
