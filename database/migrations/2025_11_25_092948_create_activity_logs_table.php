<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // 操作者
            $table->foreignId('user_id')->nullable();

            // 被操作的 Model
            $table->morphs('loggable'); // loggable_type, loggable_id

            // 動作類型：created / updated / deleted ...
            $table->string('action', 50);

            // 簡單描述（選填）
            $table->string('description')->nullable();

            // 詳細變更紀錄：old / new / dirty 等
            $table->json('properties')->nullable();

            // Request 資訊（非必要，但很好用）
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
