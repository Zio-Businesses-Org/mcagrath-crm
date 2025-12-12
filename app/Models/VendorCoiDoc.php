<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IconTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Scopes\ActiveScope;

class VendorCoiDoc extends BaseModel
{
    use IconTrait;
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'expiry_date' => 'datetime',
    ];

    const FILE_PATH = 'vendor-coi';

    protected $fillable = [];

    protected $guarded = ['id'];

    protected $table = 'vendor_coi_docs';
    public $dates = ['created_at', 'updated_at'];

    protected $appends = ['file_url', 'icon'];

    public function getCoiImageUrlAttribute()
    {
        return ($this->hashname) ? asset_url_local_s3('vendor-coi/' . $this->hashname) : null;
    }
    public function added(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by')->withoutGlobalScope(ActiveScope::class);
    }

}
