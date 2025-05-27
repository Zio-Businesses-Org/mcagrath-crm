<?php

namespace App\Models;

use App\Traits\IconTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorEstimateFiles extends BaseModel
{
    use IconTrait;

    const FILE_PATH = 'vendor-estimate-files';

    protected $fillable = [];

    public $skipObserver = false;
    
    protected $guarded = ['id'];

    protected $table = 'vendor_estimate_files';
    public $dates = ['created_at', 'updated_at'];

    protected $appends = ['file_url', 'icon'];

    public $timestamps = false;

    public function getFileUrlAttribute()
    {
        return asset_url_local_s3(VendorEstimateFiles::FILE_PATH . '/' . $this->hashname);
    }

    public function estimate(): BelongsTo
    {
        return $this->belongsTo(vendor_estimates::class);
    }
}
