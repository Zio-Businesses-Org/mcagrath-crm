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
        Schema::table('vendor_lead_statuses', function (Blueprint $table) {
            
            $statuses = [
            'Yet to Call',
            'Voicemail',
            'Unable to Connect',
            'Incorrect Ph # Listed',
            'Duplicate',
            'Initial Pitch Made',
            'Proposal Link Sent',
            'Declined by Vendor',
            'Rejected by MCG',
            'Non-Responsive',
            'Profile Created',
            'Accepted',
            ];

            foreach ($statuses as $status) {
                DB::table('vendor_lead_statuses')->insert([
                    'status' => $status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_lead_statuses', function (Blueprint $table) {
            
            DB::table('vendor_lead_statuses')->whereIn('status', [
                'Yet to Call',
                'Voicemail',
                'Unable to Connect',
                'Incorrect Ph # Listed',
                'Duplicate',
                'Initial Pitch Made',
                'Proposal Link Sent',
                'Declined by Vendor',
                'Rejected by MCG',
                'Non-Responsive',
                'Profile Created',
                'Accepted',
            ])->delete();

        });
    }
};
