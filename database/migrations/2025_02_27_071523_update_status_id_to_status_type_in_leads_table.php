<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::table('leads', function (Blueprint $table) {
            // Add new column status_type after client_id
            $table->string('status_type')->nullable()->after('client_id');
            
            // Remove old column status_id
           // $table->dropColumn('status_id');
        });
    }

    public function down() {
        Schema::table('leads', function (Blueprint $table) {
            // Revert changes if rollback is needed
            // $table->unsignedBigInteger('status_id')->nullable()->after('client_id');
            $table->dropColumn('status_type');
        });
    }
};
