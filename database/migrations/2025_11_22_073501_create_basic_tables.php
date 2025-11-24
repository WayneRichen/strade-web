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
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->comment('交易所顯示名稱');
            $table->string('code', 50)->comment('ccxt 的 id，例如： binance, bitget')->unique();
            $table->boolean('is_active')->default(true)->comment('是否啟用');
            $table->text('params')->nullable()->comment('使用者要設定的參數，例如：API Key');
            $table->timestamps();
        });

        DB::table('exchanges')->insert([
            [
                'name' => 'Bitget',
                'code' => 'bitget',
                'params' => 'api_key|secret_key|passphrase',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::create('exchange_symbols', function (Blueprint $table) {
            $table->id();
            $table->string('unified_symbol', 50)->comment('我們平台用的統一名稱');
            $table->integer('exchange_id')->unsignedInteger()->comment('對應 exchanges.id');
            $table->string('exchange_symbol', 50)->comment('我們平台用的統一名稱');
        });

        DB::table('exchange_symbols')->insert([
            [
                'unified_symbol' => 'BTCUSDT',
                'exchange_id' => 1,
                'exchange_symbol' => 'BTC/USDT:USDT',
            ],
        ]);

        Schema::create('strategies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->comment('顯示給使用者看的策略名稱');
            $table->string('unified_symbol', 50)->comment('我們平台的交易對名稱');
            $table->text('description')->nullable()->comment('描述');
            $table->string('class_name', 100)->comment('Python 策略程式名稱，例如：BTCUSDTBreakout');
            $table->boolean('is_active')->default(true)->comment('是否啟用');
            $table->timestamps();
        });

        DB::table('strategies')->insert([
            [
                'name' => '自適應趨勢突破模型',
                'unified_symbol' => 'BTCUSDT',
                'description' => '把握趨勢、衝刺動能，只在有方向、有肉可以吃的行情出手。',
                'class_name' => 'btcusdt_breakout',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::create('exchange_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsignedBigInteger()->comment('對應 users.id');
            $table->integer('exchange_id')->unsignedInteger()->comment('對應 exchanges.id');
            $table->string('name', 100)->nullable()->comment('使用者自訂名稱');
            $table->json('params')->comment('使用者的交易所的 API Key');
            $table->dateTime('last_connected_at')->nullable();
            $table->string('last_status', 50)->nullable(); // OK / INVALID_KEY 等文字
            $table->timestamps();
        });

        Schema::create('bots', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsignedBigInteger()->comment('對應 users.id');
            $table->integer('exchange_account_id')->unsignedInteger()->comment('對應 exchange_accounts.id');
            $table->integer('strategy_id')->unsignedInteger()->comment('對應 strategies.id');
            $table->string('exchange_symbol', 50)->comment('交易所的交易對名稱');
            $table->string('name', 100)->comment('使用者自訂 bot 顯示名稱');
            $table->unsignedInteger('leverage')->default(1)->comment('槓桿倍數');
            $table->decimal('base_order_usdt', 30, 10)->nullable();
            $table->json('params')->nullable();
            $table->enum('status', ['RUNNING', 'PAUSED', 'STOPPED', 'ERROR'])->default('RUNNING');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('stopped_at')->nullable();
            $table->timestamps();
            // 核心限制：同一個 exchange_account 只能被一個 bot 使用
            $table->unique('exchange_account_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
        Schema::dropIfExists('strategies');
        Schema::dropIfExists('exchange_accounts');
        Schema::dropIfExists('exchange_symbols');
        Schema::dropIfExists('bots');
    }
};
