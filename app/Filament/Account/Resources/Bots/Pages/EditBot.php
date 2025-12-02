<?php

namespace App\Filament\Account\Resources\Bots\Pages;

use App\Filament\Account\Resources\Bots\BotResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBot extends EditRecord
{
    protected static string $resource = BotResource::class;

    protected static ?string $title = '編輯交易機器人';

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

    public function getBreadcrumbs(): array
    {
        return [
            route('filament.account.resources.bots.index') => '交易機器人',
            $this->record->name ?? '交易機器人',
            '編輯',
        ];
    }
}
