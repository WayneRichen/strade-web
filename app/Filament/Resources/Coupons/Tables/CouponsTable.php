<?php

namespace App\Filament\Resources\Coupons\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CouponsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('序號')
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->label('類型')
                    ->colors([
                        'success' => 'coupon',
                        'warning' => 'referral',
                    ])
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state === 'coupon' ? '折價券' : '推薦碼'),
                TextColumn::make('discount_value')
                    ->label('折扣值')
                    ->sortable()
                    ->formatStateUsing(fn ($state, $record) => $record->discount_type === 'percent' ? ($state . '%') : ('$' . number_format($state, 0))),
                TextColumn::make('cashback_value')
                    ->label('分潤值')
                    ->sortable()
                    ->placeholder('N/A')
                    ->formatStateUsing(fn ($state, $record) => $record->cashback_type == 'percent' ? "{$state}%" : $state),
                TextColumn::make('cashbackUser.name')
                    ->label('分潤使用者')
                    ->placeholder('N/A')
                    ->sortable(),
                TextColumn::make('started_at')
                    ->label('開始時間')
                    ->sortable(),
                TextColumn::make('expired_at')
                    ->label('過期時間')
                    ->placeholder('N/A')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('啟用')
                    ->boolean(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
            ]);
    }
}
