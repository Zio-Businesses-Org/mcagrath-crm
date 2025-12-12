<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IconTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Scopes\ActiveScope;

class VendorWnineDoc extends BaseModel
{
    use IconTrait;
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'expiry_date' => 'datetime',
    ];

    const FILE_PATH = 'vendors-w9';

    protected $fillable = [];

    protected $guarded = ['id'];

    protected $table = 'vendor_wnine_docs';
    public $dates = ['created_at', 'updated_at'];

    protected $appends = ['file_url', 'icon'];

    public function getWnineimageUrlAttribute()
    {
        return ($this->hashname) ? asset_url_local_s3('vendors-w9/' . $this->hashname) : null;
    }
    public function added(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by')->withoutGlobalScope(ActiveScope::class);
    }
}
