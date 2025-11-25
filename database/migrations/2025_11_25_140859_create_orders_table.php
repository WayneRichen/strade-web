<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('strategy_trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('strategy_id')->comment('策略 id');
            $table->enum('position_side', ['LONG', 'SHORT'])->comment('持倉方向');

            $table->decimal('entry_price', 30, 10)->comment('開倉價格');
            $table->decimal('exit_price', 30, 10)->nullable()->comment('關倉價格');

            $table->timestamp('entry_at')->nullable()->comment('開單時間');
            $table->timestamp('exit_at')->nullable()->comment('平倉時間');

            $table->enum('status', ['OPEN', 'CLOSED'])->default('OPEN')->comment('訂單狀態');
            $table->decimal('pnl_pct', 9, 4)->nullable()->comment('損益');
            $table->json('extra')->nullable()->comment('備註');

            $table->timestamps();

            $table->index(['strategy_id', 'status', 'created_at']);
        });

        Schema::create('user_trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('使用者 id');
            $table->unsignedBigInteger('strategy_trade_id')->comment('策略下單訊號 id');
            $table->unsignedBigInteger('exchange_account_id')->comment('交易所帳戶 id');
            $table->unsignedBigInteger('bot_id')->comment('機器人 id');

            $table->string('exchange_symbol', 50)->comment('交易對');
            $table->enum('position_side', ['LONG', 'SHORT'])->comment('策略方向');
            $table->decimal('quantity', 30, 10)->comment('下單數量');
            $table->unsignedInteger('leverage')->default(1)->comment('槓桿倍數');

            $table->decimal('entry_price', 30, 10)->nullable()->comment('開倉價格');
            $table->decimal('exit_price', 30, 10)->nullable()->comment('平倉價格');

            $table->timestamp('opened_at')->nullable()->comment('開倉時間');
            $table->timestamp('closed_at')->nullable()->comment('平倉時間');

            $table->enum('status', ['PENDING', 'OPEN', 'CLOSING', 'CLOSED', 'FAILED'])
                ->default('PENDING')->comment('狀態');

            $table->decimal('pnl', 30, 10)->nullable()->comment('損益');
            $table->decimal('pnl_pct', 9, 4)->nullable()->comment('損益（%）');

            $table->text('error_message')->nullable()->comment('錯誤訊息');

            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['strategy_trade_id', 'status']);
        });

        Schema::create('user_trade_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_trade_id')->comment('使用者跟單 id');
            $table->string('exchange_order_id', 100)->nullable()->comment('交易所訂單編號');

            $table->enum('type', ['OPEN', 'CLOSE']);
            $table->decimal('price', 30, 10)->nullable()->comment('委託價格 (限價單)');
            $table->decimal('requested_qty', 30, 10);
            $table->decimal('filled_qty', 30, 10)->default(0);

            $table->enum('status', [
                'NEW',
                'PARTIALLY_FILLED',
                'FILLED',
                'CANCELED',
                'REJECTED'
            ])->default('NEW');

            $table->text('raw_response')->nullable();

            $table->timestamps();

            $table->index(['user_trade_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategy_trades');
        Schema::dropIfExists('user_trades');
        Schema::dropIfExists('user_trade_orders');
    }
};
