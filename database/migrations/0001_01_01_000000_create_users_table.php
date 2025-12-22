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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid')->unique()->comment('對外使用者 UID');
            $table->string('google_id')->nullable()->unique();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->rememberToken();

            $table->string('subscription_plan')->default('free')->comment('方案');
            $table->timestamp('subscription_ends_at')->nullable()->comment('會員到期日');

            $table->timestamp('last_login_at')->nullable()->comment('最後登入時間');
            $table->boolean('banned')->default(false)->comment('是否封鎖');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
