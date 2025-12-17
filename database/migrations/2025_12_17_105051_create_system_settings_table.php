<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 191)->unique()->comment('設定鍵：例如 google.uid_sheet_id');
            $table->text('value')->nullable()->comment('設定值：用 text 放字串最彈性（json/boolean/int 都可轉字串）');
            $table->string('type', 20)->default('string')->comment('值的型別（string|int|bool|json）');
            $table->string('description')->nullable()->comment('說明');
            $table->boolean('is_secret')->default(false)->comment('是否敏感資料：若要加密存放可用');
            $table->timestamps();
        });

        DB::table('system_settings')->insert([
            [
                'key' => 'google.uid_sheet_id',
                'value' => '1gY2z3cTnouv5_3VbvdO_O_5TI04l2ZSNxcBeSTcFfq0',
                'type' => 'string',
                'description' => 'UID Google Sheets 的 Spreadsheet ID（網址上 https://docs.google.com/spreadsheets/d/{spreadsheetID}/...）',
                'is_secret' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'google.uid_sheet_tab_name',
                'value' => 'Sheet1',
                'type' => 'string',
                'description' => 'UID Google Sheets 的分頁名稱',
                'is_secret' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
