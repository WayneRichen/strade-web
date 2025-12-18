<?php

namespace App\Filament\Resources\UserExchangeAccounts\Pages;

use App\Filament\Resources\UserExchangeAccounts\UserExchangeAccountResource;
use Filament\Resources\Pages\ListRecords;

class ListUserExchangeAccounts extends ListRecords
{
    protected static string $resource = UserExchangeAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}
