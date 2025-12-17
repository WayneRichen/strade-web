<?php

namespace App\Filament\Resources\ExchangeAccounts\Pages;

use App\Filament\Resources\ExchangeAccounts\ExchangeAccountResource;
use Filament\Resources\Pages\ListRecords;

class ListExchangeAccounts extends ListRecords
{
    protected static string $resource = ExchangeAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}
