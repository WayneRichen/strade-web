<?php

namespace App\Filament\Account\Resources\ExchangeAccounts\Tables;

use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ExchangeAccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('exchange.name')
                    ->label('交易所名稱')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('自訂名稱')
                    ->searchable(),
                TextColumn::make('last_connected_at')
                    ->label('最後連線時間')
                    ->placeholder('N/A')
                    ->sortable(),
                TextColumn::make('last_status')
                    ->badge()
                    ->label('連線狀態')
                    ->colors([
                        'success' => 'OK',
                        'danger' => 'INVALID',
                    ])
                    ->formatStateUsing(fn($state) => $state === 'OK' ? '成功' : '失敗')
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
            ])
            ->emptyStateIcon(Heroicon::BuildingLibrary)
            ->emptyStateHeading('還沒有連結交易所')
            ->emptyStateDescription('點右上角的「連結交易所」就能開始設定');
    }
}
