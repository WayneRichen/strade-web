<?php

namespace App\Filament\Account\Resources\Bots\Schemas;

use App\Models\Strategy;
use App\Models\ExchangeAccount;
use App\Models\ExchangeSymbol;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Facades\Auth;

class BotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // Step 1：綁定 / 選擇交易所帳戶
                    Step::make('綁定帳戶')
                        ->description('選擇要使用的交易所帳戶')
                        ->schema([
                            Select::make('exchange_account_id')
                                ->label('交易所帳戶')
                                ->options(fn() => ExchangeAccount::query()
                                    ->where('user_id', Auth::id())
                                    ->pluck('name', 'id'))
                                ->required()
                                ->searchable()
                                ->live()
                                ->afterStateUpdated(function (Get $get, Set $set) {
                                    self::syncSymbol($get, $set);
                                })
                                ->hint('先到「交易所帳戶」頁面新增再回來選')
                                ->helperText('這是 Bot 下單會用到的 API 帳戶'),

                            Placeholder::make('exchange_account_info')
                                ->label('帳戶狀態')
                                ->content(function (Get $get) {
                                    $id = $get('exchange_account_id');
                                    if (! $id) {
                                        return '請先選擇帳戶';
                                    }

                                    $account = ExchangeAccount::find($id);

                                    if (! $account) {
                                        return '帳戶不存在，請重新選擇';
                                    }

                                    return sprintf(
                                        '最後更新時間：%s 狀態：%s',
                                        $account->last_connected_at ?? '-',
                                        $account->last_status ?? '-',
                                    );
                                }),
                        ]),

                    // Step 2：選策略
                    Step::make('選策略')
                        ->description('選擇要使用的交易策略')
                        ->schema([
                            Select::make('strategy_id')
                                ->label('策略')
                                ->options(fn() => Strategy::query()
                                    ->where('is_active', 1)
                                    ->get()
                                    ->mapWithKeys(function ($strategy) {
                                        return [
                                            $strategy->id => "{$strategy->name} - {$strategy->unified_symbol}",
                                        ];
                                    }))
                                ->live()
                                ->required()
                                ->searchable()
                                ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                    if (! $state) {
                                        // 如果清空策略選擇，就把 name 也清掉
                                        $set('name', null);
                                        return;
                                    }

                                    $strategy = Strategy::find($state);

                                    if (! $strategy) {
                                        $set('name', null);
                                        return;
                                    }

                                    // 這裡你可以自己決定要帶什麼格式
                                    // 例如：策略名稱 - 交易對
                                    $set('name', "{$strategy->name} - {$strategy->unified_symbol}");

                                    self::syncSymbol($get, $set);
                                }),

                            Placeholder::make('strategy_desc')
                                ->label('策略說明')
                                ->content(function (Get $get) {
                                    $id = $get('strategy_id');
                                    if (! $id) {
                                        return '請先選擇策略';
                                    }

                                    $strategy = Strategy::find($id);

                                    if (! $strategy) {
                                        return '策略不存在，請重新選擇';
                                    }

                                    return $strategy->description ?? '此策略尚未提供說明';
                                }),

                            Hidden::make('exchange_symbol')->dehydrated(),
                        ]),

                    // Step 3：填入交易設定 / 參數
                    Step::make('填入參數')
                        ->description('設定交易商品與基本參數')
                        ->schema([
                            TextInput::make('name')
                                ->label('自訂 Bot 名稱')
                                ->required(),

                            TextInput::make('base_order_usdt')
                                ->label('投入金額 (USDT)')
                                ->numeric()
                                ->minValue(10)
                                ->default(100)
                                ->required(),

                            TextInput::make('leverage')
                                ->label('槓桿倍數')
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(100)
                                ->default(1)
                                ->required(),

                            // 預留給未來動態參數用
                            // Group::make()->schema(fn (Get $get) => $this->buildDynamicParamsSchema($get)),
                        ])
                        ->columns(2),

                    // Step 4：確認
                    Step::make('確認')
                        ->description('確認設定無誤後建立 Bot')
                        ->schema([
                            Section::make()
                                ->schema([
                                    Placeholder::make('summary_account')
                                        ->label('交易所帳戶')
                                        ->content(function (Get $get) {
                                            $id = $get('exchange_account_id');
                                            if (! $id) {
                                                return '-';
                                            }

                                            $account = ExchangeAccount::find($id);
                                            if (! $account) {
                                                return '-';
                                            }

                                            return $account->name . '（' . ($account->last_connected_at ?? '-') . '）';
                                        }),

                                    Placeholder::make('summary_strategy')
                                        ->label('策略')
                                        ->content(function (Get $get) {
                                            $id = $get('strategy_id');
                                            if (! $id) {
                                                return '-';
                                            }

                                            $strategy = Strategy::find($id);
                                            if (! $strategy) {
                                                return '-';
                                            }

                                            return $strategy->name . ' - ' . $strategy->unified_symbol;
                                        }),

                                    Placeholder::make('summary_exchange_symbol')
                                        ->label('交易對')
                                        ->content(fn(Get $get) => $get('exchange_symbol') ?: '-'),

                                    Placeholder::make('summary_allocated')
                                        ->label('投入金額 (USDT)')
                                        ->content(fn(Get $get) => $get('base_order_usdt') ?: '-'),

                                    Placeholder::make('summary_leverage')
                                        ->label('槓桿倍數')
                                        ->content(fn(Get $get) => $get('leverage') ?: '-'),
                                ])
                                ->columns(2),

                            Placeholder::make('summary_tip')
                                ->label('提示')
                                ->content('確認以上設定無誤後，按下「建立 Bot」會建立機器人並交給背景 Job 啟動。'),
                        ]),
                ])
            ]);
    }

    protected static function syncSymbol(Get $get, Set $set): void
    {
        $exchangeAccountId = $get('exchange_account_id');
        $strategyId = $get('strategy_id');

        if (! $exchangeAccountId || ! $strategyId) {
            $set('symbol', null);
            return;
        }

        $account  = ExchangeAccount::find($exchangeAccountId);
        $strategy = Strategy::find($strategyId);

        if (!$account || !$strategy) {
            $set('symbol', null);
            return;
        }

        $unifiedSymbol = $strategy->unified_symbol; // BTCUSDT 這個

        $exchangeSymbol = ExchangeSymbol::query()
            ->where('exchange_id', $account->exchange_id)
            ->where('unified_symbol', $unifiedSymbol)
            ->value('exchange_symbol'); // 例如 BTC/USDT:USDT

        // 找不到就退回 unified_symbol 當備案
        $set('exchange_symbol', $exchangeSymbol ?? $unifiedSymbol);
    }
}
