<?php

namespace App\Filament\Account\Resources\ExchangeAccounts\Pages;

use App\Exchanges\Bitget;
use App\Filament\Account\Resources\ExchangeAccounts\ExchangeAccountResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateExchangeAccount extends CreateRecord
{
    protected static string $resource = ExchangeAccountResource::class;

    protected static ?string $title = '連結交易所帳戶';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getBreadcrumbs(): array
    {
        return [
            route('filament.account.resources.exchange-accounts.index') => '交易所帳戶',
            '連結交易所',
        ];
    }

    public function testApiKey()
    {
        $state = $this->form->getState();

        $exchangeId = $state['exchange_id'] ?? null;
        $params = array_values($state['params']) ?? [];

        // 這裡之後想支援多家交易所可以一直加
        $exchanges = [
            1 => Bitget::class,
        ];

        if (!$exchangeId || !isset($exchanges[$exchangeId])) {
            Notification::make()
                ->title('無效的交易所')
                ->body('請先選擇正確的交易所。')
                ->danger()
                ->send();

            return;
        }

        $exchangeClass = $exchanges[$exchangeId];

        try {
            $exchange = new $exchangeClass(...$params);

            $response = $exchange->check();

            $this->data['last_connected_at'] = now();
            $this->data['last_status'] = 'OK';
            $this->data['raw_response'] = $response;

            Notification::make()
                ->title('API Key 測試成功')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            $this->data['last_status'] = 'INVALID';
            $this->data['raw_response'] = $e->getMessage();

            Notification::make()
                ->title('API Key 測試失敗')
                ->body("錯誤訊息：{$e->getMessage()}")
                ->danger()
                ->send();
        }
    }
}
