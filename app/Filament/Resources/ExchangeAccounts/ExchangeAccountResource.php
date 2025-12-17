<?php

namespace App\Filament\Resources\ExchangeAccounts;

use App\Filament\Resources\ExchangeAccounts\Pages\ListExchangeAccounts;
use App\Filament\Resources\ExchangeAccounts\Schemas\ExchangeAccountForm;
use App\Filament\Resources\ExchangeAccounts\Tables\ExchangeAccountsTable;
use App\Models\ExchangeAccount;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExchangeAccountResource extends Resource
{
    protected static ?string $model = ExchangeAccount::class;

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
        return ExchangeAccountForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExchangeAccountsTable::configure($table);
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
            'index' => ListExchangeAccounts::route('/'),
        ];
    }
}
