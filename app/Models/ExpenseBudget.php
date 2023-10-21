<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpenseBudget extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 0;

    const STATUS_PUBLISH = 1;

    const STATUS = [
        0 => 'IN ACTIVE',
        1 => 'ACTIVE',
    ];

    public function budgetType(): BelongsTo
    {
        return $this->belongsTo(BudgetType::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function cluster(): BelongsTo
    {
        return $this->belongsTo(Cluster::class);
    }

    public function historyExpenseBudget(): HasMany
    {
        return $this->hasMany(HistoryExpenseBudget::class);
    }

    public function budgetPlanner(): HasMany
    {
        return $this->hasMany(BudgetPlanner::class);
    }
}
