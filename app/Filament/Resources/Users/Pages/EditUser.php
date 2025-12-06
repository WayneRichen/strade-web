<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = '編輯使用者';

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getBreadcrumbs(): array
    {
        return [
            route('filament.admin.resources.users.index') => '使用者',
            $this->record->name ?? '使用者', // 動態顯示使用者名稱
            '編輯',
        ];
    }
}
