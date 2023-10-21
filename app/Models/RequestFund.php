<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class RequestFund extends Model
{
    use HasFactory;

    public function budgetPlanner(): BelongsTo
    {
        return $this->belongsTo(BudgetPlanner::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function statusHistory(): HasMany
    {
        return $this->hasMany(RequestFundStatusHistory::class);
    }

    public function statusHistoryLates()
    {
        return $this->belongsTo(RequestFundStatusHistory::class,'id','request_fund_id')->latest();
    }
}
