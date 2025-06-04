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
        Schema::table('project_activity', function (Blueprint $table) {
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('change_user_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_activity', function (Blueprint $table) {
            //
        });
    }
};
