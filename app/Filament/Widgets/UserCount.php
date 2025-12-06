<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserCount extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('會員數', User::count()),
        ];
    }
}
