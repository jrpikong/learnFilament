<?php

namespace App\Models;

use App\Events\TopupBudgetPlannerEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BudgetPlanner extends Model
{
    use HasFactory;

    protected $casts = [
        'start' => 'date',
        'end'   => 'date'
    ];

    const STATUS_DRAFT = 0;

    const STATUS_PUBLISH = 1;

    const STATUS = [
        0 => 'DRAFT',
        1 => 'PUBLISH',
    ];

    public function cluster(): BelongsTo
    {
        return $this->belongsTo(Cluster::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function expenseBudget(): BelongsTo
    {
        return $this->belongsTo(ExpenseBudget::class);
    }

    public function accountPlanner(): HasMany
    {
        return $this->hasMany(AccountPlanner::class);
    }

    public function historyPlanner(): HasMany
    {
        return $this->hasMany(HistoryBudgetPlanner::class);
    }

    protected $dispatchesEvents = [
        'created'   => TopupBudgetPlannerEvent::class
    ];
}
