<?php

namespace App\Filament\Resources\SystemSettings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;

class SystemSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        $lockOnEdit = fn(Get $get) => filled($get('id'));
        $showMeta = fn($record) => $record === null;

        return $schema
            ->components([
                TextInput::make('value')
                    ->label('Value')
                    ->password(fn($get) => (bool) $get('is_secret'))
                    ->revealable(fn($get) => (bool) $get('is_secret'))
                    ->visible(fn($record) => !$showMeta($record))
                    ->required(fn($get) => $get('type') !== 'json')
                    ->columnSpanFull(),

                Section::make('設定')
                    ->visible(fn($record) => $showMeta($record))
                    ->schema([
                        TextInput::make('key')
                            ->label('Key')
                            ->unique(ignoreRecord: true)
                            ->disabled($lockOnEdit)
                            ->columnSpanFull(),

                        Select::make('type')
                            ->label('型別')
                            ->options([
                                'string' => 'string',
                                'int' => 'int',
                                'bool' => 'bool',
                                'json' => 'json',
                            ])
                            ->default('string')
                            ->required(),

                        Toggle::make('is_secret')
                            ->label('敏感值（顯示遮罩）'),

                        Textarea::make('description')
                            ->label('說明')
                            ->rows(2)
                            ->columnSpanFull(),

                        TextInput::make('value')
                            ->label('Value')
                            ->password(fn($get) => (bool) $get('is_secret'))
                            ->revealable(fn($get) => (bool) $get('is_secret'))
                            ->required(fn($get) => $get('type') !== 'json')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
