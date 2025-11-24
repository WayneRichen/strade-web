<?php

namespace App\Filament\Account\Resources\ExchangeAccounts\Pages;

use App\Exchanges\Bitget;
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
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
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

            $assets = $exchange->getBalance();

            if (empty($assets)) {
                Notification::make()
                    ->title('API Key 測試結果')
                    ->body('連線成功，但帳戶沒有資產或查不到餘額。')
                    ->warning()
                    ->send();

                return;
            }

            // 簡單組一個顯示文字
            $summary = collect($assets)
                ->take(5) // 不要一次秀太多
                ->map(function ($asset) {
                    return $asset['coin'] . ': ' . $asset['available'];
                })
                ->implode("\n");

            Notification::make()
                ->title('API Key 測試成功')
                ->body("成功取得餘額，前幾筆如下：\n" . $summary)
                ->success()
                ->send();

        } catch (\Throwable $e) {
            Notification::make()
                ->title('API Key 測試失敗')
                ->body("錯誤訊息：{$e->getMessage()}")
                ->danger()
                ->send();
        }
    }
}
