<?php

namespace App\Http\Controllers;

use App\Models\StrategyTrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $trades = Cache::remember('strategy_1_closed_trades', now()->addHour(), function () {
            return StrategyTrade::where('strategy_id', 1)
                ->whereIn('status', ['CLOSED', 'TP_CLOSED', 'SL_CLOSED'])
                ->get();
        });

        return view('index', [
            'trades' => $trades->slice(-10),
            'backtestData' => $trades,
        ]);
    }
}
