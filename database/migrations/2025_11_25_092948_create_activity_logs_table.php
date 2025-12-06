<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->comment('操作者');

            // 被操作的 Model
            $table->morphs('loggable'); // loggable_type, loggable_id

            $table->string('action', 50)->comment('動作類型：created / updated / deleted');
            $table->string('description')->nullable()->comment('簡單描述（選填）');
            $table->json('properties')->nullable()->comment('詳細變更紀錄：old / new / dirty 等');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('url', 500)->nullable();

            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
