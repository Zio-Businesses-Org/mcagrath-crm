<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCustomFilter extends BaseModel
{
    use HasFactory;

    protected $casts = [
        'project_category' => 'array',
        'project_sub_category' => 'array',
        'project_type' => 'array',
        'project_priority' => 'array',
        'project_status' => 'array',
        'delayed_by'=>'array',
        'client_id' => 'array',
        'city' => 'array',
        'state' => 'array',
        'county' => 'array',
        'project_members' => 'array',
        'sort_order' => 'array',
    ];
}
