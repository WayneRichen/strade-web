<?php

namespace App\Filament\Account\Resources\Bots\Pages;

use App\Filament\Account\Resources\Bots\BotResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBots extends ListRecords
{
    protected static string $resource = BotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
