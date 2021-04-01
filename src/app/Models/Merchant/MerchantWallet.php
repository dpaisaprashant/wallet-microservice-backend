<?php

namespace App\Models\Merchant;

use Illuminate\Database\Eloquent\Model;

class MerchantWallet extends Model
{
    protected $connection = 'dpaisa';

    protected $fillable = ['merchant_id', 'balance'];

    protected $casts = [
        'balance' => 'integer'
    ];

    /**
     * @param $balance
     * @return float|int
     */
    public function getBalanceAttribute($balance)
    {
        return ($balance/100);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

}
