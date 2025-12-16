<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('code', 64)->unique()->comment('優惠碼');
            $table->string('type', 32)->default('coupon')->comment('coupon/referral/lifetime/...');

            $table->string('discount_type', 16)->comment('percent/fixed');
            $table->decimal('discount_value', 12, 2);

            $table->string('cashback_type', 16)->nullable()->comment('percent/fixed');
            $table->decimal('cashback_value', 12, 2)->nullable()->comment('回饋值');
            $table->unsignedInteger('cashback_user_id')->nullable()->comment('回饋給指定用戶 ID');

            $table->unsignedInteger('max_usage')->nullable()->comment('最大使用次數');
            $table->timestamp('started_at')->useCurrent()->comment('開始使用時間');
            $table->timestamp('expired_at')->nullable()->comment('過期時間');

            $table->boolean('is_active')->default(true)->comment('是否啟用');

            $table->json('meta')->nullable(); // 擴充用（條件、限制、備註等）

            $table->timestamps();

            $table->index(['is_active', 'started_at', 'expired_at']);
            $table->index(['type']);
        });

        Schema::create('coupon_usages', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);

            $table->unsignedBigInteger('coupon_id')->comment('對應到 coupons.id');
            $table->unsignedBigInteger('user_id')->comment('對應到 users.id');

            $table->unsignedBigInteger('order_id')->nullable()->comment('對應到 orders.id');
            $table->decimal('discount_amount', 12, 2)->default(0)->comment('折扣金額');
            $table->decimal('cashback_amount', 12, 2)->nullable()->comment('現金回饋金額');

            $table->timestamp('used_at')->useCurrent()->comment('使用時間');

            $table->timestamps();

            $table->index(['coupon_id', 'user_id']);
            $table->index(['user_id', 'used_at']);
            $table->index(['coupon_id', 'used_at']);
            $table->index(['order_id']);
        });

        Schema::create('user_discounts', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);

            $table->unsignedBigInteger('user_id')->comment('對應到 users.id');
            $table->unsignedBigInteger('source_coupon_id')->nullable()->comment('來源優惠券 ID');

            $table->string('discount_type', 16)->comment('percent/fixed');
            $table->decimal('discount_value', 12, 2)->comment('折扣金額');

            $table->timestamp('started_at')->useCurrent()->comment('開始時間');
            $table->timestamp('expired_at')->nullable()->comment('過期時間');

            $table->boolean('is_active')->default(true)->comment('是否啟用');
            $table->json('meta')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'is_active', 'expired_at']);
            $table->index(['source_coupon_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('coupon_usages');
        Schema::dropIfExists('user_discounts');
    }
};
