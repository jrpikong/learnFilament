<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class AccountGroup extends Model
{
    use HasRoles, SoftDeletes;

    protected $fillable = ['code', 'name'];

    /**
     * @return HasMany
     */
    public function account(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
