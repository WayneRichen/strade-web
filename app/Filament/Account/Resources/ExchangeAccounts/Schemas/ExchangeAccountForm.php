<?php

namespace App\Filament\Account\Resources\ExchangeAccounts\Schemas;

use App\Models\Exchange;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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
                                ->autocomplete(false)
                                ->required(),

                            Hidden::make('last_connected_at')
                                ->dehydrated() // 儲存時會一起帶進去
                                ->default(null),

                            Hidden::make('last_status')
                                ->dehydrated() // 儲存時會一起帶進去
                                ->default(null),

                            Hidden::make('raw_response')
                                ->dehydrated() // 儲存時會一起帶進去
                                ->default(null),

                            Section::make('API 參數')
                                ->schema(function (Get $get) {
                                    try {
                                        $serverIp = $serverIp = cache()->remember('server_public_ip', 3600, function () {
                                            return trim(Http::get('https://ipv4.icanhazip.com')->body());
                                        });
                                    } catch (\Throwable $e) {
                                        $serverIp = '無法取得，請稍後重試';
                                    }

                                    $components[] = Placeholder::make('server_ip')
                                        ->label('伺服器 IP（請加到交易所白名單）')
                                        ->copyable()
                                        ->content($serverIp);

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
                                                ->autocomplete(false)
                                                ->live()
                                                ->required();
                                        })
                                        ->values()
                                        ->all();

                                    $components[] = Action::make('test_key')
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
                                        ->icon('heroicon-o-check');

                                    return $components;
                                }),
                        ],
                    ),
                ]
            );
    }
}
