<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpensePartialPay extends BaseModel
{
    use HasFactory;

    const FILE_PATH = 'expense-partial-pay-bill';

    protected $casts = [
        'pay_date'=> 'datetime',
    ];

    public function getBillUrlAttribute()
    {
        return ($this->bill) ? asset_url_local_s3(ExpensePartialPay::FILE_PATH . '/' . $this->bill) : '';
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
    public function projectvendor(): BelongsTo
    {
        return $this->belongsTo(ProjectVendor::class, 'vendor_id');
    }

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ExpensesCategory::class, 'category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by')->withoutGlobalScope(ActiveScope::class);
    }

}
