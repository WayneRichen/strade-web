<?php

namespace App\Filament\Account\Resources\Bots;

use App\Filament\Account\Resources\Bots\Pages\CreateBot;
use App\Filament\Account\Resources\Bots\Pages\EditBot;
use App\Filament\Account\Resources\Bots\Pages\ListBots;
use App\Filament\Account\Resources\Bots\Schemas\BotForm;
use App\Filament\Account\Resources\Bots\Tables\BotsTable;
use App\Models\Bot;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BotResource extends Resource
{
    protected static ?string $model = Bot::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CommandLine;

    protected static ?string $recordTitleAttribute = 'Bot';

    protected static ?string $navigationLabel = '交易機器人';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());  // 只抓自己的資料
    }

    public static function getModelLabel(): string
    {
        return '交易機器人';
    }

    public static function getPluralModelLabel(): string
    {
        return '交易機器人';
    }

    public static function form(Schema $schema): Schema
    {
        return BotForm::configure($schema)->columns(1);
    }

    public static function table(Table $table): Table
    {
        return BotsTable::configure($table);
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
            'index' => ListBots::route('/'),
            'create' => CreateBot::route('/create'),
            'edit' => EditBot::route('/{record}/edit'),
        ];
    }
}
