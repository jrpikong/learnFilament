<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'name',];

    public function AccountGroup(): BelongsTo
    {
        return $this->belongsTo(AccountGroup::class);
    }

    public function submissionFlow(): HasMany
    {
        return $this->hasMany(SubmissionFlow::class);
    }

    public function absorptionFlow(): HasMany
    {
        return $this->hasMany(AbsorptionFlow::class);
    }
}
