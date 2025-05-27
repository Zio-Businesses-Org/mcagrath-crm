<?php

namespace App\Models;

use App\Traits\HasCompany;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class vendor_estimates extends BaseModel
{
    use HasCompany;

    protected $casts = [
        'valid_till' => 'datetime',
        'last_viewed' => 'datetime',
    ];
    
    public $skipObserver = false;

    public static function lastEstimateNumber()
    {
        return (int)vendor_estimates::latest()->first()?->original_estimate_number ?? 0;
    }
    
    public function formatEstimateNumber()
    {
        $invoiceSettings = (company()) ? company()->invoiceSetting : $this->company->invoiceSetting;
        return \App\Helper\NumberFormat::estimate($this->estimate_number, $invoiceSettings);
    }
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function vendors(): BelongsTo
    {
        return $this->belongsTo(VendorContract::class, 'vendor_id');
    }
    public function items(): HasMany
    {
        return $this->hasMany(vendor_estimates_items::class, 'vendor_estimate_id');
    }
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function files(): HasMany
    {
        return $this->hasMany(VendorEstimateFiles::class, 'vendor_estimates_id')->orderByDesc('id');
    }
    public function added(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by')->withoutGlobalScope(ActiveScope::class);
    }
}
