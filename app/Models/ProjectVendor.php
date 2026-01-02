<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectVendor extends BaseModel
{
    use HasFactory;
    
    protected $casts = [
        'sow_id' => 'array',
        'created_at' => 'datetime',
        'inspection_date'=>'datetime',
        're_inspection_date'=>'datetime',
        'bid_submitted_date'=>'datetime',
        'bid_rejected_date'=>'datetime',
        'bid_approval_date'=>'datetime',
        'work_schedule_date'=>'datetime',
        'work_schedule_re_date'=>'datetime',
        'work_completion_date'=>'datetime',
        'bid_ecd'=>'datetime',
        'work_ecd'=>'datetime',
        'due_date'=>'datetime',
        'accepted_date'=>'datetime',
        'rejected_date'=>'datetime',
        'cancelled_date'=>'datetime',
        'invoiced_date'=>'datetime',
        'paid_date'=>'datetime',
        'bid_approved_amount' => 'float',
    ];
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function client()
    {
        return $this->hasOneThrough(
            User::class, // The related model (Client model)
            Project::class, // The intermediate model (Project model)
            'id', // Foreign key on the projects table (project_id)
            'id', // Foreign key on the users table (client_id)
            'project_id', // Local key on the project_vendors table (project_id)
            'client_id' // Local key on the projects table
        )->withoutGlobalScope(ActiveScope::class);
    }
   

    public function projectshort($data)
    {
        $project_short_code = Project::withTrashed()->without('members')->select('project_short_code')->find($data);
        return $project_short_code->project_short_code;
    }
    
    public function changenotification(): HasMany
    {
        return $this->hasMany(VendorChangeNotification::class, 'project_vendor_id')->orderByDesc('id');
    }

    public function latestChangeNotification(): HasOne
    {
        return $this->hasOne(
            VendorChangeNotification::class,
            'project_vendor_id'
        )->latestOfMany();
    }

    
    public function linksentby(): BelongsTo
    {
        return $this->belongsTo(User::class, 'link_sent_by')->withoutGlobalScope(ActiveScope::class);
    }
    public function sowname($data)
    {  
        $scopeofwork= ScopeOfWork::withTrashed()->find($data);
        return $scopeofwork;
    }
    public function sowcategory($data)
    {
        $scopeofwork= ScopeOfWork::withTrashed()->find($data);
        return $scopeofwork->category;
    }
    public function sowsubcategory($data)
    {
        $scopeofwork= ScopeOfWork::withTrashed()->find($data);
        return $scopeofwork->sub_category;
    }
    public function sowdescription($data)
    {
        $scopeofwork= ScopeOfWork::withTrashed()->find($data);
        return $scopeofwork->description;
    }
    
    public function vendorimage($id)
    {
        $image = VendorContract::findOrFail($id);
        
        return $image->image_url;
    }
    public function vendors(): BelongsTo
    {
        return $this->belongsTo(VendorContract::class, 'vendor_id');
    }

    public function getChangeOrderAmountsAttribute()
    {
        return number_format(
            $this->changenotification
                ->where('link_status', 'Accepted')
                ->whereNotNull('accepted_date')
                ->pluck('project_amount')
                ->map(fn($amount) => (float) $amount)
                ->sum(),
            2, '.', ''
        );
    }

}
