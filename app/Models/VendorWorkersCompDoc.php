<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IconTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Scopes\ActiveScope;

class VendorWorkersCompDoc extends BaseModel
{
    use IconTrait;
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'expiry_date' => 'datetime',
    ];

    const FILE_PATH = 'vendor-workers-comp';

    protected $fillable = [];

    protected $guarded = ['id'];

    protected $table = 'vendor_workers_comp_docs';
    public $dates = ['created_at', 'updated_at'];

    protected $appends = ['file_url', 'icon'];

    public function getWcimageUrlAttribute()
    {
        return ($this->hashname) ? asset_url_local_s3('vendor-workers-comp/' . $this->hashname) : null;
    }
    public function added(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by')->withoutGlobalScope(ActiveScope::class);
    }
}
