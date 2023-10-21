<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPlannerHistory extends Model
{
    use HasFactory;

    public static function insertHistory($user, $planner_id, $account_id,
                                         $account_name, $from, $to, $before_amount, $amount, $ending_amount,
                                         $entry, $type, $method,$ref_id=null)
    {
        $accP = new self();
        $accP->authorized = $user;
        $accP->account_planner_id = $planner_id;
        $accP->account_id = $account_id;
        $accP->from = $from;
        $accP->to = $to;
        $accP->ref_id = $ref_id;
        $accP->account_name = $account_name;
        $accP->before_amount = $before_amount;
        $accP->amount = $amount;
        $accP->after_amount = $ending_amount;
        $accP->entry = $entry;
        $accP->type = $type;
        $accP->method = $method;
        $accP->save();
    }
}
