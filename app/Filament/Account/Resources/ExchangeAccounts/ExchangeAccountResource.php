<?php

namespace App\Filament\Account\Resources\ExchangeAccounts;

use App\Filament\Account\Resources\ExchangeAccounts\Pages\CreateExchangeAccount;
use App\Filament\Account\Resources\ExchangeAccounts\Pages\EditExchangeAccount;
use App\Filament\Account\Resources\ExchangeAccounts\Pages\ListExchangeAccounts;
use App\Filament\Account\Resources\ExchangeAccounts\Schemas\ExchangeAccountForm;
use App\Filament\Account\Resources\ExchangeAccounts\Tables\ExchangeAccountsTable;
use App\Models\ExchangeAccount;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExchangeAccountResource extends Resource
{
    protected static ?string $model = ExchangeAccount::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ExchangeAccount';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());  // 只抓自己的資料
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
            'create' => CreateExchangeAccount::route('/create'),
            'edit' => EditExchangeAccount::route('/{record}/edit'),
        ];
    }
}
