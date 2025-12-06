<?php

namespace App\Filament\Resources\StrategyTrades\Pages;

use App\Filament\Resources\StrategyTrades\StrategyTradeResource;
use Filament\Resources\Pages\ListRecords;

class ListStrategyTrades extends ListRecords
{
    protected static string $resource = StrategyTradeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
