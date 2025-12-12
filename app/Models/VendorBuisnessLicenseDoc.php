<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IconTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Scopes\ActiveScope;

class VendorBuisnessLicenseDoc extends BaseModel
{
    use IconTrait;
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'expiry_date' => 'datetime',
    ];

    const FILE_PATH = 'vendor-buisness-license';

    protected $fillable = [];

    protected $guarded = ['id'];

    protected $table = 'vendor_buisness_license_docs';
    public $dates = ['created_at', 'updated_at'];

    protected $appends = ['file_url', 'icon'];

    public function getBulimageUrlAttribute()
    {
        return ($this->hashname) ? asset_url_local_s3('vendor-buisness-license/' . $this->hashname) : null;
    }
    public function added(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by')->withoutGlobalScope(ActiveScope::class);
    }
}
