<?php

namespace App\Filament\Account\Resources\Bots\Pages;

use App\Filament\Account\Resources\Bots\BotResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBot extends EditRecord
{
    protected static string $resource = BotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
