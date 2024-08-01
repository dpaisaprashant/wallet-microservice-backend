<?php

namespace App\Models;


use App\Traits\BelongsToUser;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Model;

class UserReferralBonusTransaction extends Model
{
    use BelongsToUser, MorphOneTransaction;

    protected $connection = 'dpaisa';
    protected $guarded = [];


    CONST TYPE_FIRST_TRANSACTION = 'FIRST TRANSACTION';
    CONST TYPE_KYC_VERIFIED = 'KYC VERIFIED';

    /**
     * @param $amount
     * @return float|int
     */
    public function getAmountAttribute($amount)
    {
        if ($amount == null || $amount == 'o') {
            return 0;
        }
        return ($amount/100);
    }
}
