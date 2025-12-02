<?php

namespace App\Filament\Account\Resources\ExchangeAccounts\Pages;

use App\Filament\Account\Resources\ExchangeAccounts\ExchangeAccountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExchangeAccounts extends ListRecords
{
    protected static string $resource = ExchangeAccountResource::class;

    protected static ?string $title = '交易所帳戶';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('連結交易所'),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}
