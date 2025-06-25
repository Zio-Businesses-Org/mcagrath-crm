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
        Schema::create('expense_partial_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('expense_id')->nullable()->index('partial_pay_expense_id_foreign');
            $table->foreign(['expense_id'])->references(['id'])->on('expenses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedInteger('project_id')->nullable()->index('partial_pay_project_id_foreign');
            $table->foreign(['project_id'])->references(['id'])->on('projects')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedInteger('vendor_id')->nullable()->index('partial_pay_vendor_id_foreign');
            $table->foreign(['vendor_id'])->references(['id'])->on('project_vendors')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->date('purchase_date');
            $table->double('price', 16, 2);
            $table->unsignedBigInteger('category_id')->nullable()->index('partial_pay_category_id_foreign');
            $table->foreign(['category_id'])->references(['id'])->on('expenses_category')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('payment_method')->nullable();
            $table->string('additional_fee')->nullable();
            $table->string('bill')->nullable();
            $table->unsignedInteger('added_by')->nullable()->index('partial_pay_category_added_by_foreign');
            $table->unsignedInteger('last_updated_by')->nullable()->index('partial_pay_category_last_updated_by_foreign');
            $table->foreign(['added_by'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['last_updated_by'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_partial_pays');
    }
};
