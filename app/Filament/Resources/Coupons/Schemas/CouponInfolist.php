<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CouponInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                TextEntry::make('discount_value')->numeric()->label('折扣值')
                    ->formatStateUsing(fn($state, $record) => $record->discount_type === 'percent' ? ($state . '%') : ('$' . number_format($state, 0))),
                TextEntry::make('cashback_value')
                    ->label('分潤值')
                    ->placeholder('N/A')
                    ->formatStateUsing(fn($state, $record) => $record->cashback_type == 'percent' ? "{$state}%" : $state),
                TextEntry::make('cashbackUser.name')
                    ->label('分潤使用者')
                    ->placeholder('N/A'),
            ]);
    }
}
