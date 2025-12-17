<?php

namespace App\Filament\Account\Resources\UserTrades;

use App\Filament\Account\Resources\UserTrades\RelationManagers\OrdersRelationManager;
use App\Filament\Account\Resources\UserTrades\Pages\ListUserTrades;
use App\Filament\Account\Resources\UserTrades\Pages\ViewUserTrade;
use App\Filament\Account\Resources\UserTrades\Schemas\UserTradeInfolist;
use App\Filament\Account\Resources\UserTrades\Tables\UserTradesTable;
use App\Models\UserTrade;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserTradeResource extends Resource
{
    protected static ?string $model = UserTrade::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentList;

    protected static ?string $recordTitleAttribute = null;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function getModelLabel(): string
    {
        return '訂單紀錄';
    }

    public static function getPluralModelLabel(): string
    {
        return '訂單紀錄';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserTradeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserTradesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            OrdersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUserTrades::route('/'),
            'view' => ViewUserTrade::route('/{record}'),
        ];
    }
}
