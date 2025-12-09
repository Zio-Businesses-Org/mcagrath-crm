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
        Schema::table('vendor_general_settings', function (Blueprint $table) {
            $table->boolean('duplicate_entry_check')->default(true)->after('selfnotifymail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_general_settings', function (Blueprint $table) {
            //
        });
    }
};
