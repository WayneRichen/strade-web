<?php

namespace App\Filament\Resources\SystemSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SystemSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->label('Key')->searchable(),
                TextColumn::make('type')->label('型別')->badge(),
                TextColumn::make('value')
                    ->label('Value')
                    ->formatStateUsing(fn($state, $record) => $record->is_secret ? '••••••••' : (string) $state)
                    ->limit(40),
                TextColumn::make('description')->label('說明')->limit(40),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([])
            ->paginationPageOptions([20, 50, 100])
            ->defaultPaginationPageOption(20);
    }
}
