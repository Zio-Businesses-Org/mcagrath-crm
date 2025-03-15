<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientLeadCustomFilter extends BaseModel
{
    use HasFactory;
    protected $casts = [
        'added_by' => 'array',
        'company_type' => 'array',
        'client_lead_status'=>'array',
    ];
}
