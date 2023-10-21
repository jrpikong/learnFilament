<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Period extends Model
{

    protected $guarded = ['id'];

    protected $casts = ['start' => 'date', 'end' => 'date'];

    public function expenseBudget(): HasOne
    {
        return $this->hasOne(ExpenseBudget::class);
    }
}
