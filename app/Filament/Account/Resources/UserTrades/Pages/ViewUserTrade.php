<?php

namespace App\Filament\Account\Resources\UserTrades\Pages;

use App\Filament\Account\Resources\UserTrades\UserTradeResource;
use Filament\Resources\Pages\ViewRecord;

class ViewUserTrade extends ViewRecord
{
    protected static string $resource = UserTradeResource::class;

    protected static ?string $title = '倉位紀錄';

    protected function getHeaderActions(): array
    {
        return [];
    }
}
