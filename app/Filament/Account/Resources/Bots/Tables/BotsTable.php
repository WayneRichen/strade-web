<?php

namespace App\Filament\Account\Resources\Bots\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BotsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('名稱')
                    ->searchable(),
                TextColumn::make('exchangeAccount.name')
                    ->label('交易所帳戶')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('strategy.name')
                    ->label('策略名稱')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('exchange_symbol')
                    ->label('交易對')
                    ->sortable(),
                TextColumn::make('leverage')
                    ->label('槓桿倍數')
                    ->numeric()
                    ->suffix('x')
                    ->sortable(),
                TextColumn::make('base_order_usdt')
                    ->label('每次下單金額')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('狀態')
                    ->badge()
                    ->sortable(),
                TextColumn::make('started_at')
                    ->label('開始時間')
                    ->sortable(),
                TextColumn::make('stopped_at')
                    ->label('停止時間')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateIcon(Heroicon::CommandLine)
            ->emptyStateHeading('還沒有交易機器人')
            ->emptyStateDescription('連結交易所之後就可以開始新增囉！');
    }
}
