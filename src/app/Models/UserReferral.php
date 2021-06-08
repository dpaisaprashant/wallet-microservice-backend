<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class UserReferral extends Model
{
    use BelongsToUser;

    protected $guarded = [];

    protected $connection = 'dpaisa';

    public function getUserFromReferralCode($code)
    {
        return User::whereHas('referral', function ($query) use ($code) {
            return $query->where('code', $code);
        })->first();
    }
}
