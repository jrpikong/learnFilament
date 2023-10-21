<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestFundStatusHistory extends Model
{
    use HasFactory;

//    protected $casts = ['authorized'];


    const STATUS_CREATED = 0;
    const STATUS_REVIEW = 1;
    const STATUS_FA_REVIEW = 2;
    const STATUS_FA_EXECUTOR = 3;
    const STATUS_DONE = 4;
    const STATUS_REJECT = 5;

    const STATUS = [
        self::STATUS_CREATED => 'CREATED',
        self::STATUS_REVIEW => 'IN REVIEW',
        self::STATUS_FA_REVIEW => 'FINANCE REVIEW',
        self::STATUS_FA_EXECUTOR => 'FINANCE EXECUTOR',
        self::STATUS_DONE => 'DONE',
        self::STATUS_REJECT => 'REJECT',
    ];

    const STATUS_SUBMISSION = [
        self::STATUS_REVIEW => 'IN REVIEW',
        self::STATUS_FA_REVIEW => 'FINANCE REVIEW',
        self::STATUS_FA_EXECUTOR => 'FINANCE EXECUTOR',
        self::STATUS_DONE => 'DONE',
        self::STATUS_REJECT => 'REJECT',
    ];

    public function requestFund(): BelongsTo
    {
        return $this->belongsTo(RequestFund::class);
    }

    public function authorizedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'authorized', 'id');
    }

    const TYPE = [
        'ROUTINE COST' => 'ROUTINE COST',
        'NON-ROUTINE COST'  => 'NON-ROUTINE COST'
    ];
}
