<?php

namespace App\Filament\Account\Widgets;

use App\Models\Bot;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActiveBots extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('運作中的交易機器人', Bot::query()->where('user_id', auth()->id())->where('status', 'RUNNING')->count()),
        ];
    }
}
