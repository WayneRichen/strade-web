<?php

namespace App\Filament\Account\Resources\UserTrades\RelationManagers;

use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $title = '倉位紀錄';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('exchange_order_id')
            ->columns([
                TextColumn::make('exchange_order_id')
                    ->label('交易所訂單編號')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('type')
                    ->label('類型')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'OPEN' => 'success',
                        'CLOSE' => 'warning',
                    })
                    ->formatStateUsing(fn($state) => $state === 'OPEN' ? '開倉' : '平倉'),

                TextColumn::make('price')
                    ->label('委託價格')
                    ->numeric(2),

                TextColumn::make('requested_qty')
                    ->label('委託數量')
                    ->numeric(4),

                TextColumn::make('filled_qty')
                    ->label('成交數量')
                    ->numeric(4),

                TextColumn::make('fee')
                    ->label('手續費')
                    ->numeric(6),

                TextColumn::make('status')
                    ->label('狀態')
                    ->badge()
                    ->colors([
                        'primary' => 'NEW',
                        'warning' => 'PARTIALLY_FILLED',
                        'success' => 'FILLED',
                        'danger' => 'CANCELED',
                    ]),

                TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime('Y-m-d H:i:s'),

                TextColumn::make('raw_response')
                    ->label('交易所回應')
                    ->limit(20),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('viewRaw')
                    ->label('查看回應')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->outlined()
                    ->visible(fn($record) => filled($record->raw_response))
                    ->modalHeading('交易所回應')
                    ->modalSubmitAction(false) // 只讀，不需要送出按鈕
                    ->modalCancelActionLabel('關閉')
                    ->modalContent(function ($record) {
                        $raw = $record->raw_response;

                        $decoded = json_decode($raw, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $raw = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                        }

                        return new HtmlString(
                            '<pre class="text-xs whitespace-pre-wrap font-mono">' .
                                e($raw) .
                                '</pre>'
                        );
                    }),
            ]);
    }
}
