<?php

namespace App\Filament\Account\Resources\Bots\Pages;

use App\Filament\Account\Resources\Bots\BotResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBot extends CreateRecord
{
    protected static string $resource = BotResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['started_at'] = now();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
