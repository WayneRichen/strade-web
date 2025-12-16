<?php

namespace App\Filament\Resources\Coupons\Schemas;

use App\Models\Coupon;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class CouponForm
{
    public static function configure(Schema $schema): Schema
    {
        $lockOnEdit = fn(Get $get) => filled($get('id'));

        return $schema
            ->columns(2)
            ->components([
                Section::make([
                    TextInput::make('code')
                        ->label('折價券序號')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->disabled($lockOnEdit)
                        ->dehydrated(fn(Get $get) => blank($get('id')))
                        ->suffixAction(
                            Action::make('generateCode')
                                ->label('產生')
                                ->icon('heroicon-m-arrow-path')
                                ->disabled($lockOnEdit)
                                ->action(function (Set $set) {
                                    do {
                                        $code = Str::upper(Str::random(6));
                                    } while (Coupon::query()->where('code', $code)->exists());

                                    $set('code', $code);
                                })
                        ),

                    Select::make('type')->label('折價券類型')
                        ->default('coupon')->options([
                            'coupon' => '折價券',
                            'referral' => '推薦碼',
                        ])
                        ->live()
                        ->disabled($lockOnEdit)
                        ->dehydrated(fn(Get $get) => blank($get('id')))
                        ->afterStateUpdated(function (Set $set, $state) {
                            if ($state !== 'referral') {
                                $set('cashback_type', null);
                                $set('cashback_value', null);
                                $set('cashback_user_id', null);
                            }
                        })
                        ->required(),

                    Select::make('discount_type')->label('折扣類型')
                        ->default('percent')->options([
                            'percent' => '百分比',
                            'fixed' => '固定金額',
                        ])
                        ->live()
                        ->disabled($lockOnEdit)
                        ->dehydrated(fn(Get $get) => blank($get('id')))
                        ->required(),
                    TextInput::make('discount_value')
                        ->label(fn(Get $get) => $get('discount_type') === 'percent' ? '折扣百分比' : '折扣金額')
                        ->required()
                        ->numeric()
                        ->suffix(fn(Get $get) => $get('discount_type') === 'percent' ? '%' : null)
                        ->minValue(0)
                        ->maxValue(fn(Get $get) => $get('discount_type') === 'percent' ? 100 : null)
                        ->disabled($lockOnEdit)
                        ->dehydrated(fn(Get $get) => blank($get('id'))),

                    Select::make('cashback_type')->label('分潤類型')
                        ->default('percent')
                        ->options([
                            'percent' => '百分比',
                            'fixed' => '固定金額',
                        ])
                        ->live()
                        ->visible(fn(Get $get) => $get('type') === 'referral')
                        ->required(fn(Get $get) => $get('type') === 'referral')
                        ->disabled($lockOnEdit)
                        ->dehydrated(fn(Get $get) => blank($get('id'))),
                    TextInput::make('cashback_value')
                        ->label(fn(Get $get) => $get('cashback_type') === 'percent' ? '分潤百分比' : '分潤金額')
                        ->numeric()
                        ->visible(fn(Get $get) => $get('type') === 'referral')
                        ->required(fn(Get $get) => $get('type') === 'referral')
                        ->suffix(fn(Get $get) => $get('cashback_type') === 'percent' ? '%' : null)
                        ->minValue(0)
                        ->maxValue(fn(Get $get) => $get('cashback_type') === 'percent' ? 100 : null)
                        ->disabled($lockOnEdit)
                        ->dehydrated(fn(Get $get) => blank($get('id'))),

                    Select::make('cashback_user_id')->label('分潤給使用者')
                        ->options(fn() => User::query()->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->visible(fn(Get $get) => $get('type') === 'referral')
                        ->required(fn(Get $get) => $get('type') === 'referral')
                        ->disabled($lockOnEdit)
                        ->dehydrated(fn(Get $get) => blank($get('id'))),

                    DateTimePicker::make('started_at')
                        ->label('開始使用時間')
                        ->disabled($lockOnEdit)
                        ->dehydrated(fn(Get $get) => blank($get('id')))
                        ->default(now())
                        ->required(),
                    DateTimePicker::make('expired_at')
                        ->disabled($lockOnEdit)
                        ->dehydrated(fn(Get $get) => blank($get('id')))
                        ->label('過期時間'),

                    Toggle::make('is_active')
                        ->label('是否啟用')
                        ->default(true),

                    TextInput::make('meta'),
                ])->columnSpan(1),
            ]);
    }
}
