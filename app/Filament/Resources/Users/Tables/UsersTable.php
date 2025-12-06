<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('')
                    ->circular(),
                TextColumn::make('name')
                    ->label('姓名')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Gmail')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('角色')
                    ->badge()
                    ->separator(', '),
                TextColumn::make('invitedBy.name')
                    ->label('推薦人')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('invite_count')
                    ->label('邀請人數')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('subscription_plan')
                    ->label('方案')
                    ->searchable(),
                TextColumn::make('subscription_ends_at')
                    ->label('方案到期日')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('last_login_at')
                    ->label('最後登入時間')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
            ])
            ->emptyStateHeading('沒有使用者')
            ->paginationPageOptions([20, 50, 100])
            ->defaultPaginationPageOption(20);
    }
}
