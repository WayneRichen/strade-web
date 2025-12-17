<?php

namespace App\Filament\Resources\ExchangeAccounts\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExchangeAccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.uid')
                    ->label('UID')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('使用者')
                    ->searchable(),
                TextColumn::make('exchange.name')
                    ->label('交易所')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('帳戶名稱')
                    ->searchable(),
                TextColumn::make('exchange_uid')
                    ->label('交易所 UID')
                    ->searchable(),
                TextColumn::make('last_connected_at')
                    ->label('最後連線時間'),
                TextColumn::make('last_status')
                    ->label('連線狀態')
                    ->badge()
                    ->colors([
                        'success' => 'OK',
                        'danger' => 'INVALID',
                    ])
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([]);
    }
}
