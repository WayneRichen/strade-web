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

    public function getBreadcrumbs(): array
    {
        return [
            route('filament.account.resources.user-trades.index') => '訂單紀錄',
        ];
    }
}
