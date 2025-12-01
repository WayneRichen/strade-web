<?php

namespace App\Filament\Account\Resources\UserTrades\Pages;

use App\Filament\Account\Resources\UserTrades\UserTradeResource;
use Filament\Resources\Pages\ListRecords;

class ListUserTrades extends ListRecords
{
    protected static string $resource = UserTradeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
