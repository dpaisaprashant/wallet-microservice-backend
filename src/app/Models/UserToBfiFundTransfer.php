<?php

namespace App\Models;

use App\Models\BFI\BFIUser;
use App\Traits\BelongsToUser;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Model;

class UserToBfiFundTransfer extends Model
{
    use BelongsToUser, MorphOneTransaction;

    protected $connection = "bfi";

    public function getAmountAttribute($amount){
        return ($amount/100);
    }

    public function bfiUser(){
        return $this->belongsTo(BFIUser::class,'user_id');
    }
}
