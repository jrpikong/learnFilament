<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AccountPlanner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function budgetPlanner(): BelongsTo
    {
        return $this->belongsTo(BudgetPlanner::class,'budget_planner_id','id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function accountPlannerHistory(): HasMany
    {
        return $this->hasMany(AccountPlannerHistory::class);
    }
}
