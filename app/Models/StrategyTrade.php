<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrategyTrade extends Model
{
    use HasFactory;

    /**
     * 對應資料表名稱
     */
    protected $table = 'strategy_trades';

    /**
     * 批次賦值欄位
     */
    protected $fillable = [
        'strategy_id',
        'position_side',
        'entry_price',
        'exit_price',
        'entry_at',
        'exit_at',
        'status',
        'pnl_pct',
        'extra',
    ];

    /**
     * 型別轉換
     */
    protected $casts = [
        'strategy_id' => 'integer',
        'entry_price' => 'decimal:10',
        'exit_price' => 'decimal:10',
        'entry_at' => 'datetime',
        'exit_at' => 'datetime',
        'pnl_pct' => 'decimal:4',
        'extra' => 'array', // json -> array
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * 持倉方向常數
     */
    public const SIDE_LONG = 'LONG';
    public const SIDE_SHORT = 'SHORT';

    /**
     * 訂單狀態常數
     */
    public const STATUS_OPEN = 'OPEN';
    public const STATUS_CLOSED = 'CLOSED';
    public const STATUS_TP_CLOSED = 'TP_CLOSED';
    public const STATUS_SL_CLOSED = 'SL_CLOSED';

    /**
     * 常用 Scope：指定策略
     */
    public function scopeForStrategy($query, int $strategyId)
    {
        return $query->where('strategy_id', $strategyId);
    }

    /**
     * 常用 Scope：只撈已平倉
     */
    public function scopeClosed($query)
    {
        return $query->whereIn('status', [
            self::STATUS_CLOSED,
            self::STATUS_TP_CLOSED,
            self::STATUS_SL_CLOSED,
        ]);
    }

    /**
     * 常用 Scope：依 exit_at 區間
     */
    public function scopeExitBetween($query, ?string $from, ?string $to)
    {
        if ($from) {
            $query->where('exit_at', '>=', $from);
        }

        if ($to) {
            $query->where('exit_at', '<=', $to);
        }

        return $query;
    }

    public function strategy()
    {
        return $this->belongsTo(Strategy::class);
    }
}
