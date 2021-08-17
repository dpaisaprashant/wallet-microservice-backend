<?php

namespace App\Models;

use App\Filters\User\UserFilters;
use App\Filters\Wallet\WalletFilters;
use App\Traits\WalletDetails;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new WalletFilters($request))->add($filters)->filter($builder);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
