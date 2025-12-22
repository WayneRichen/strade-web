<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'md' => 2,
                ])
                    ->columnSpan(2)
                    ->schema([
                        Section::make([
                            ImageEntry::make('avatar')->circular()->hiddenLabel(),
                            TextEntry::make('name')->label('姓名')->copyable(),
                            TextEntry::make('uid')->label('UID')->copyable(),
                            TextEntry::make('google_id')->label('Google ID')->copyable(),
                            TextEntry::make('email')->label('Gmail')->icon(Heroicon::Envelope)->copyable(),
                            TextEntry::make('last_login_at')->label('最後登入時間'),
                            Toggle::make('banned')->label('封鎖使用者'),
                            Select::make('subscription_plan')->label('訂閱方案')->default('free')->options([
                                'free' => 'free',
                                'premium' => 'premium',
                            ])->required(),
                            DateTimePicker::make('subscription_ends_at')->label('方案到期日'),
                        ]),
                        Section::make('權限管理')
                            ->schema([
                                Select::make('roles')
                                    ->label('角色')
                                    ->relationship('roles', 'name', modifyQueryUsing: function ($query) {
                                        // 若目前登入者不是 super_admin，則把 super_admin 角色從列表移除
                                        if (!auth()->user()->hasRole('super_admin')) {
                                            $query->where('name', '!=', 'super_admin');
                                        }
                                    })
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),
                            ])
                            ->collapsed(false),
                    ]),
            ]);
    }
}
