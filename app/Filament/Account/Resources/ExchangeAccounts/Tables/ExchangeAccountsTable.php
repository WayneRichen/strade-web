<?php

namespace App\Filament\Account\Resources\ExchangeAccounts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
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
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('last_connected_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('last_status')
                    ->searchable(),
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
            ->emptyStateIcon(Heroicon::BuildingLibrary)
            ->emptyStateHeading('還沒有連結交易所')
            ->emptyStateDescription('點擊右上角「連結交易所」');
    }
}
