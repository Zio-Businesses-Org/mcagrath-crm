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
            $table->string('selfwaivernotificationmail')->nullable()->after('duplicate_entry_check');
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
