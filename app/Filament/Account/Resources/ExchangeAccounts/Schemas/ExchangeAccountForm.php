<?php

namespace App\Filament\Account\Resources\ExchangeAccounts\Schemas;

use App\Models\Exchange;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Get;

class ExchangeAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(
                [
                    Grid::make([
                        'default' => 1,
                    ])->components(
                            [

                                Select::make('exchange_id')
                                    ->label('交易所')
                                    ->relationship(name: 'exchange', titleAttribute: 'name')
                                    ->required()
                                    ->live(),

                                TextInput::make('name')
                                    ->label('帳號名稱')
                                    ->placeholder('例如：我的 Binance 帳號')
                                    ->required(),

                                Section::make('API 參數')
                                    ->schema(function (Get $get) {
                                        $exchangeId = $get('exchange_id');

                                        if (!$exchangeId) {
                                            return [];
                                        }

                                        $exchange = Exchange::find($exchangeId);

                                        if (!$exchange || empty($exchange->params)) {
                                            return [];
                                        }

                                        // params: "api_key|secret_key|passphrase"
                                        $keys = explode('|', $exchange->params);

                                        return collect($keys)
                                            ->filter() // 避免空字串
                                            ->map(function (string $key) {
                                                $label = Str::of($key)
                                                    ->replace('_', ' ')
                                                    ->title(); // api_key -> Api Key
                                
                                                return TextInput::make("params.$key")
                                                    ->label($label)
                                                    ->password()    // 通常這種都是敏感資訊
                                                    ->required()
                                                    ->live();
                                            })
                                            ->values()
                                            ->all();
                                    }),

                                Action::make('test_key')
                                    ->label('測試金鑰')
                                    ->action('testApiKey')
                                    ->color('primary')
                                    ->requiresConfirmation()
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
                                    ->icon('heroicon-o-check'),
                            ],
                        ),
                ]
            );
    }
}
