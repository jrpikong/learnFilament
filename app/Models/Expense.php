<?php

namespace App\Models;

use App\Casts\ReadableNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use HasFactory;

//    protected $casts = [
//        'amount'    => ReadableNumber::class
//    ];

    public function requestFund(): BelongsTo
    {
        return $this->belongsTo(RequestFund::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


    public function statusHistory(): HasMany
    {
        return $this->hasMany(ExpenseStatusHistory::class);
    }

    public function statusHistoryLates()
    {
        return $this->belongsTo(ExpenseStatusHistory::class,'id','expense_id')->latest();
    }
}
