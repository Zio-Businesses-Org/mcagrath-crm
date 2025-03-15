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
        Schema::create('client_lead_custom_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('vendor_custom_filters_user_id_foreign');
            $table->date('last_called_start_date')->nullable();
            $table->date('last_called_end_date')->nullable();
            $table->date('next_follow_start_date')->nullable();
            $table->date('next_follow_end_date')->nullable();
            $table->json('company_type')->nullable();
            $table->json('client_lead_status')->nullable();
            $table->json('added_by')->nullable();
            $table->string('status')->nullable()->default('inactive'); 
            $table->string('name')->nullable();
            $table->timestamps();
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_lead_custom_filters');
    }
};
