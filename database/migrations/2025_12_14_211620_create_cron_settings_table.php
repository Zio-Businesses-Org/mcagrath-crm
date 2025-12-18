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
        Schema::create('cron_settings', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->nullable();
            $table->string('queue command')->nullable();
            $table->string('queue description')->nullable();
            $table->dateTime('latest_execution')->nullable();
            $table->unsignedInteger('created_by')->nullable()->index('cron_settings_created_by_foreign');
            $table->foreign(['created_by'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cron_settings');
    }
};
