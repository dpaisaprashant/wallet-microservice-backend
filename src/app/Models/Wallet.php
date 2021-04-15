<?php

namespace App\Models;

use App\Traits\WalletDetails;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use WalletDetails;

    protected $table = "wallets";
    protected $connection = 'dpaisa';


    /**
     * @param $balance
     * @return float|int
     */
    public function getBalanceAttribute($balance)
    {
        return ($balance/100);
    }

    public function getBonusBalanceAttribute($balance)
    {
        return ($balance/100);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
