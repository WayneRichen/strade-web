<?php

namespace App\Filament\Account\Resources\ExchangeAccounts\Pages;

use App\Filament\Account\Resources\ExchangeAccounts\ExchangeAccountResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExchangeAccount extends EditRecord
{
    protected static string $resource = ExchangeAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
