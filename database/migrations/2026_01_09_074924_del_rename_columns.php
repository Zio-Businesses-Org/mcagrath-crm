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
        Schema::table('cron_settings', function () {
             DB::statement("
                ALTER TABLE cron_settings
                RENAME COLUMN `queue command` TO queue_command
            ");

            DB::statement("
                ALTER TABLE cron_settings
                RENAME COLUMN `queue description` TO queue_description
            ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cron_settings', function (Blueprint $table) {
            //
        });
    }
};
