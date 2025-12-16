<?php

namespace App\Filament\Resources\StrategyTrades;

use App\Filament\Resources\StrategyTrades\Pages\ListStrategyTrades;
use App\Filament\Resources\StrategyTrades\Tables\StrategyTradesTable;
use App\Models\StrategyTrade;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StrategyTradeResource extends Resource
{
    protected static ?string $model = StrategyTrade::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentList;

    protected static ?string $recordTitleAttribute = null;

    public static function getModelLabel(): string
    {
        return '策略訂單紀錄';
    }

    public static function getPluralModelLabel(): string
    {
        return '策略訂單紀錄';
    }

    public static function table(Table $table): Table
    {
        return StrategyTradesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStrategyTrades::route('/'),
        ];
    }
}
