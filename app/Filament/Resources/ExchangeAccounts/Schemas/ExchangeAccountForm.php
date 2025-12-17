<?php

namespace App\Filament\Resources\ExchangeAccounts\Schemas;

use App\Models\Exchange;
use Filament\Actions\Action;
use Filament\Schemas\Components\Actions;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ExchangeAccountForm
{
    public static function configure(Schema $schema): Schema
    {

        return $schema
            ->components([
                TextInput::make('name')->label('帳戶名稱')->disabled(),
                Hidden::make('exchange_id'),
                TextInput::make('exchange_uid')->label('交易所 UID')->disabled(),
                Section::make('API 參數')
                    ->schema(function (Get $get) {
                        $components = [];

                        $exchangeId = $get('exchange_id');

                        if (!$exchangeId) {
                            return $components;
                        }
                        $exchange = Exchange::find($exchangeId);

                        if (!$exchange || empty($exchange->params)) {
                            return [];
                        }

                        // params: "api_key|secret_key|passphrase"
                        $keys = explode('|', $exchange->params);

                        collect($keys)
                            ->filter() // 避免空字串
                            ->each(function (string $key) use (&$components) {
                                $label = Str::of($key)
                                    ->replace('_', ' ')
                                    ->title(); // api_key -> Api Key

                                $components[] = TextInput::make("params.$key")
                                    ->label($label)
                                    ->password()
                                    ->revealable()
                                    ->disabled()
                                    ->autocomplete(false)
                                    ->live()
                                    ->required();
                            })
                            ->values()
                            ->all();

                        return $components;
                    }),
                Select::make('last_status')->label('連線狀態')->options([
                    'OK' => 'OK',
                    'INVALID' => 'INVALID',
                ]),
                Actions::make([
                    Action::make('test_key')
                        ->label('測試金鑰')
                        ->color('primary')
                        ->disabled(function (callable $get) {
                            $exchangeId = $get('exchange_id');
                            if (!$exchangeId) {
                                return true;
                            }

                            $exchange = Exchange::find($exchangeId);
                            if (!$exchange || empty($exchange->params)) {
                                return true;
                            }

                            $keys = explode('|', $exchange->params);

                            // 檢查所有欄位是否都有填
                            foreach ($keys as $key) {
                                if (blank($get("params.$key"))) {
                                    return true;
                                }
                            }

                            return false;
                        })
                        ->extraAttributes([
                            'class' => 'mt-2',
                        ])
                        ->action(function (Get $get, Set $set) {
                            $exchangeId = $get('exchange_id');
                            $paramsAssoc = $get('params') ?? [];

                            // 依你的原本需求：用 values 進 constructor
                            $params = array_values($paramsAssoc);

                            $exchanges = [
                                1 => \App\Exchanges\Bitget::class,
                            ];

                            if (!$exchangeId || !isset($exchanges[$exchangeId])) {
                                \Filament\Notifications\Notification::make()
                                    ->title('無效的交易所')
                                    ->body('請先選擇正確的交易所。')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            try {
                                $exchangeClass = $exchanges[$exchangeId];
                                $exchange = new $exchangeClass(...$params);
                                $response = $exchange->check();

                                $set('last_connected_at', now());
                                $set('last_status', 'OK');
                                $set('raw_response', $response['raw_response']);
                                $set('exchange_uid', $response['uid']);

                                $whiteListCheck = collect(app(\App\Services\GoogleSheetService::class, [
                                    'spreadsheetId' => \App\Services\Settings::get('google.uid_sheet_id'),
                                ])->getAllRows(\App\Services\Settings::get('google.uid_sheet_tab_name')))
                                    ->skip(1)
                                    ->pluck(1)
                                    ->flip()
                                    ->has($response['uid']);

                                if (!$whiteListCheck) {
                                    $set('last_status', 'INVALID');

                                    \Filament\Notifications\Notification::make()
                                        ->title('API Key 測試成功，但 UID 未在白名單中')
                                        ->body('請聯絡管理員將您的 UID 加入白名單。')
                                        ->warning()
                                        ->send();
                                    return;
                                }

                                \Filament\Notifications\Notification::make()
                                    ->title('API Key 測試成功')
                                    ->success()
                                    ->send();
                            } catch (\Throwable $e) {
                                $set('last_status', 'INVALID');
                                $set('raw_response', $e->getMessage());

                                \Filament\Notifications\Notification::make()
                                    ->title('API Key 測試失敗')
                                    ->body("錯誤訊息：{$e->getMessage()}")
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->icon('heroicon-o-check'),
                ]),
                Textarea::make('raw_response')->label('交易所回應')
                    ->columnSpanFull()->disabled(),
            ]);
    }
}
