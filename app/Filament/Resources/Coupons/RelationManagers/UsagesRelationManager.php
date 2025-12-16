<?php

namespace App\Filament\Resources\Coupons\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class UsagesRelationManager extends RelationManager
{
    protected static string $relationship = 'usages';

    protected static ?string $title = '使用情形';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.uid')
                    ->label('UID')
                    ->searchable(),
                TextColumn::make('order_id')
                    ->label('訂單編號')
                    ->searchable(),
                TextColumn::make('discount_amount')
                    ->label('折扣金額')
                    ->numeric(),
                TextColumn::make('cashback_amount')
                    ->label('分潤金額')
                    ->numeric(decimalPlaces: 2)
                    ->summarize(Sum::make()->label('分潤加總')->money()),
                TextColumn::make('used_at')
                    ->label('使用時間'),
            ])
            ->defaultSort('used_at', 'desc')
            ->filters([
                Filter::make('used_at')
                    ->label('使用時間區間')
                    ->form([
                        DatePicker::make('from')
                            ->label('起始日期'),
                        DatePicker::make('until')
                            ->label('結束日期'),
                    ])
                    ->columnSpan(2)
                    ->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn(Builder $q, $date) =>
                                $q->whereDate('used_at', '>=', $date)
                            )
                            ->when(
                                $data['until'] ?? null,
                                fn(Builder $q, $date) =>
                                $q->whereDate('used_at', '<=', $date)
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['from'] ?? null) {
                            $indicators[] = '從：' . $data['from'];
                        }

                        if ($data['until'] ?? null) {
                            $indicators[] = '到：' . $data['until'];
                        }

                        return $indicators;
                    }),
            ], \Filament\Tables\Enums\FiltersLayout::AboveContent)
            ->headerActions([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
