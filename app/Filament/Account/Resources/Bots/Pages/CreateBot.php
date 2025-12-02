<?php

namespace App\Filament\Account\Resources\Bots\Pages;

use App\Filament\Account\Resources\Bots\BotResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBot extends CreateRecord
{
    protected static string $resource = BotResource::class;

    protected static ?string $title = '新增交易機器人';

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

    public function getBreadcrumbs(): array
    {
        return [
            route('filament.account.resources.bots.index') => '交易機器人',
            '新增交易機器人',
        ];
    }
}
