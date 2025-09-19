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
        // Move data from expenses → expense_process_payments
        DB::table('expenses')->orderBy('id')->chunk(100, function ($expenses) {
            foreach ($expenses as $expense) {
                DB::table('expense_process_payments')->insert([
                    'expense_id'      => $expense->id,
                    'project_id'      => $expense->project_id,
                    'vendor_id'       => $expense->vendor_id,
                    'additional_fee'  => $expense->additional_fee,
                    'bill'            => $expense->bill,
                    'payment_date'    => $expense->pay_date,
                    'price'           => $expense->price,
                    'payment_method'  => $expense->payment_method,
                    'added_by'        => $expense->added_by,
                    'last_updated_by' => $expense->last_updated_by,
                    'created_at'      => $expense->created_at,
                    'updated_at'      => $expense->updated_at,
                ]);
            }
        });

        // Drop old columns from expenses
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn([
                'additional_fee',
                'bill',
                'pay_date',
                'price',
                'payment_method',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expense_process_payments', function (Blueprint $table) {
            //
        });
    }
};
