<?php

namespace App\Filament\Account\Resources\UserTrades\Tables;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserTradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bot.name')
                    ->label('Bot')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('exchange_symbol')
                    ->label('交易對')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('position_side')
                    ->badge()
                    ->label('方向')
                    ->colors([
                        'success' => 'LONG',
                        'danger' => 'SHORT',
                    ])
                    ->formatStateUsing(fn($state) => $state === 'LONG' ? '做多' : '做空'),

                TextColumn::make('quantity')
                    ->label('數量')
                    ->numeric(4)
                    ->sortable(),

                TextColumn::make('leverage')
                    ->label('槓桿')
                    ->suffix('x')
                    ->sortable(),

                TextColumn::make('entry_price')
                    ->label('進場價')
                    ->numeric(2)
                    ->sortable(),

                TextColumn::make('exit_price')
                    ->label('出場價')
                    ->numeric(2)
                    ->sortable(),

                TextColumn::make('pnl')
                    ->label('盈虧')
                    ->numeric(2)
                    ->color(fn($record) => $record->pnl >= 0 ? 'success' : 'danger')
                    ->sortable(),

                TextColumn::make('pnl_pct')
                    ->label('ROI (%)')
                    ->formatStateUsing(fn($state) => number_format($state, 2) . '%')
                    ->color(fn($record) => $record->pnl_pct >= 0 ? 'success' : 'danger')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('狀態')
                    ->badge()
                    ->colors([
                        'gray' => 'OPEN',
                        'gray' => 'CLOSED',
                        'danger' => 'ERROR',
                    ]),

                TextColumn::make('opened_at')
                    ->label('開倉時間')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),

                TextColumn::make('closed_at')
                    ->label('平倉時間')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->recordActions([
                Action::make('closeOrder')
                    ->label('手動關單')
                    ->icon(Heroicon::AdjustmentsHorizontal)
                    ->visible(fn($record) => $record->status !== 'CLOSED') // 已關閉就不顯示
                    ->requiresConfirmation()
                    ->modalHeading('你確定要將此倉位標記為 CLOSED 嗎？')
                    ->modalDescription('⚠️ 此動作只會變更後台狀態，不會對交易所下任何指令。請確認你真的要標記為已關閉。')
                    ->modalSubmitActionLabel('是的，標記為 CLOSED')
                    ->modalCancelActionLabel('取消')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'CLOSED',
                        ]);
                    })
                    ->after(function () {
                        Notification::make()
                            ->title('倉位已更新為 CLOSED')
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
