<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryExpenseBudget extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at'    => 'date:Y-m-d H:i:s'
    ];

    public function expenseBudget(): BelongsTo
    {
        return $this->belongsTo(ExpenseBudget::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
