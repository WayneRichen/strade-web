<?php

namespace App\Filament\Resources\StrategyTrades\Tables;

use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class StrategyTradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('strategy.name')
                    ->label('策略'),
                TextColumn::make('position_side')
                    ->badge()
                    ->label('方向')
                    ->colors([
                        'success' => 'LONG',
                        'danger' => 'SHORT',
                    ])
                    ->formatStateUsing(fn($state) => $state === 'LONG' ? '做多' : '做空'),
                TextColumn::make('entry_price')
                    ->label('開倉價格')
                    ->money(),
                TextColumn::make('exit_price')
                    ->label('平倉價格')
                    ->money(),
                TextColumn::make('entry_at')
                    ->label('開倉時間')
                    ->sortable(),
                TextColumn::make('exit_at')
                    ->label('平倉時間')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('狀態')
                    ->badge()
                    ->colors([
                        'gray' => 'OPEN',
                        'gray' => 'CLOSED',
                    ]),
                TextColumn::make('pnl_pct')
                    ->label('盈虧（%）')
                    ->formatStateUsing(fn($state) => number_format($state, 2) . '%')
                    ->color(fn($record) => $record->pnl_pct >= 0 ? 'success' : 'danger'),
                TextColumn::make('extra')
                    ->label('備註')
                    ->tooltip(fn($record) => $record->extra)
                    ->limit(20),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('strategy_id')
                    ->label('策略')
                    ->multiple()
                    ->relationship('strategy', 'name')
                    ->searchable()
                    ->preload(),

                Filter::make('exit_at')
                    ->label('交易時間區間')
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
                                $q->whereDate('exit_at', '>=', $date)
                            )
                            ->when(
                                $data['until'] ?? null,
                                fn(Builder $q, $date) =>
                                $q->whereDate('exit_at', '<=', $date)
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
            ->recordActions([
                Action::make('viewRaw')
                    ->label('查看備註')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->outlined()
                    ->visible(fn($record) => filled($record->extra))
                    ->modalHeading('備註')
                    ->modalSubmitAction(false) // 只讀，不需要送出按鈕
                    ->modalCancelActionLabel('關閉')
                    ->modalContent(function ($record) {
                        $raw = $record->extra;

                        $decoded = json_decode($raw, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $raw = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                        }

                        return new HtmlString(
                            '<pre class="text-xs whitespace-pre-wrap font-mono">' .
                                e($raw) .
                                '</pre>'
                        );
                    }),
            ])
            ->toolbarActions([
            ])
            ->emptyStateHeading('沒有訂單紀錄')
            ->paginationPageOptions([20, 50, 100])
            ->defaultPaginationPageOption(20);
    }
}
