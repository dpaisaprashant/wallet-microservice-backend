<?php

namespace App\Models;


use App\Filters\Transaction\TransactionFilters;

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

    protected $appends = [
        'main_balance'
    ];


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


    public function getMainBalanceAttribute()
    {
        return $this->attributes['balance'] + $this->attributes['bonus_balance'];
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new WalletFilters($request))->add($filters)->filter($builder);

    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

  /*  public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new TransactionFilters($request))->add($filters)->filter($builder);
    }*/

}
