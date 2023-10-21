<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cluster extends Model
{
    use HasFactory;

    public function branches(): BelongsTo
    {
        return $this->belongsTo(Branch::class,'id','cluster_id');
    }
}
