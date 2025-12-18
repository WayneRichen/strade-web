<?php

namespace App\Filament\Resources\UserExchangeAccounts;

use App\Filament\Resources\UserExchangeAccounts\Pages\ListUserExchangeAccounts;
use App\Filament\Resources\UserExchangeAccounts\Schemas\UserExchangeAccountForm;
use App\Filament\Resources\UserExchangeAccounts\Tables\UserExchangeAccountsTable;
use App\Models\UserExchangeAccount;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserExchangeAccountResource extends Resource
{
    protected static ?string $model = UserExchangeAccount::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingLibrary;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = '使用者交易所帳戶';

    public static function getModelLabel(): string
    {
        return '使用者交易所帳戶';
    }

    public static function getPluralModelLabel(): string
    {
        return '使用者交易所帳戶';
    }

    public static function form(Schema $schema): Schema
    {
        return UserExchangeAccountForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserExchangeAccountsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUserExchangeAccounts::route('/'),
        ];
    }
}
