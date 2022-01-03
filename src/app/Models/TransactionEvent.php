<?php

namespace App\Models;

use App\Filters\Transaction\TransactionFilters;
use App\Models\Clearance;
use App\Models\User;
use App\Traits\BelongsToUser;
use App\Traits\MorphOneCommission;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TransactionEvent extends Model
{
    use BelongsToUser, MorphOneCommission;
    protected $table = 'transaction_events';
    protected $connection = 'dpaisa';
    protected $guarded = [];
    //protected $with = ['current_balance'];

    protected $casts = [
        "amount" => "integer"
    ];

    protected $appends = ["fee"];

    /**
     * @param $amount
     * @return float|int
     */
    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    /**
     * @param $balance
     * @return float|int
     */
    public function getBalanceAttribute($balance)
    {
        return ($balance/100);
    }

    /**
     * @param $balance
     * @return float|int
     */
    public function getBonusBalanceAttribute($balance)
    {
        return ($balance/100);
    }


    public function getFeeAttribute()
    {
        $createdAtDate = Carbon::parse($this->created_at)->format("Y-m-d");
        switch ($this->transaction_type) {
            case NchlLoadTransaction::class:

                if ($createdAtDate >= Carbon::parse("2021-11-23")) {
                    if ($this->amount <= 500) {
                        return 2;
                    }elseif ($this->amount >= 501 && $this->amount <= 50000) {
                        return 4;
                    }elseif ($this->amount >= 50001) {
                        return 8;
                    }
                }

                if ($this->amount <= 500) {
                    return 2;
                }elseif ($this->amount >= 501 && $this->amount <= 50000) {
                    return 5;
                }elseif ($this->amount >= 50001) {
                    return 10;
                }
            case NpsLoadTransaction::class:
                if ($this->amount >= 10 && $this->amount <= 1000) {
                    return (0.5 / 100) * $this->amount;
                }elseif ($this->amount >= 1001) {
                    return 7;
                }
            case UserLoadTransaction::class:
                if ($this->vendor == "SCT") {
                    return (2 / 100) * $this->amount;
                }

                return (1 / 100) * $this->amount;

            case NchlBankTransfer::class:
            case NchlAggregatedPayment::class:
                if ($this->amount <= 500) {
                    return 2;
                }elseif ($this->amount >= 501 && $this->amount <= 5000) {
                    return 5;
                }elseif ($this->amount >= 5001 && $this->amount <= 25000) {
                    return 10;
                } elseif ($this->amount >= 25001 ) {
                    return 10;
                }
            case NICAsiaCyberSourceLoadTransaction::class:
                return (3.5/100) * $this->amount;
            case UserTransaction::class:
                if ($this->vendor == "NTC") {
                    if ($this->service_type == "EPIN") {
                        return (3.5 / 100) * $this->amount;
                    }
                    return (3.84 / 100) * $this->amount;
                } elseif ($this->vendor == "DISHHOME") {
                    if ($this->service_type == "EPIN") {
                        return (3.5 / 100) * $this->amount;
                    }
                    return (3.7 / 100) * $this->amount;
                } elseif ($this->vendor == "NCELL")
                {
                    //if ($this->created_at > '2020-03-24') {
                    return (3.25 / 100) * $this->amount;
                    //}
                    //return (4 / 100) * $this->amount;

                } elseif ($this->vendor == "NETTV_EPIN" || $this->vendor == "NETTV") {
                    return (4 / 100) * $this->amount;
                } elseif ($this->vendor == "SMARTCELL") {

                    if ($this->service_type == "EPIN")
                    {
                        //if (Carbon::createFromFormat('Y-m-d', $this->created_at)->gt(Carbon::createFromFormat('Y-m-d', '2020-07-22'))) {
                        //  return (4.5 / 100) * $this->amount;
                        //}
                        return (2.7 / 100) * $this->amount;
                    }
                    return (2.7 / 100 ) * $this->amount;
                } elseif ($this->vendor == "SIMTV") {
                    return (3.6 / 100) * $this->amount;
                } elseif($this->vendor == "SUBISU") {
                    return (0.9 / 100) * $this->amount;
                } elseif ($this->vendor == "WORLDLINK") {
                    return (0.9 / 100) * $this->amount;
                } elseif ($this->vendor == "VIANET") {
                    return (0.9 / 100) * $this->amount;
                } elseif ($this->vendor == "MEROTV") {
                    return (2.5 / 100) * $this->amount;
                } elseif ($this->vendor == "WEBSURFER") {
                    return (0.9 / 100) * $this->amount;
                } elseif ($this->vendor == "ARROWNET") {
                    return (0.9 / 100) * $this->amount;
                } elseif ($this->vendor == "PRABHUTV") {
                    return (3 / 100) * $this->amount;
                } elseif ($this->vendor == "PRABHUNET") {
                    return (2.5 / 100) * $this->amount;
                }


            default:
                return 0;
        }
    }

    /* public function getCurrentBalanceAttribute(){
         return $this->attributes['balance'] / 100;
     }*/

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new TransactionFilters($request))->add($filters)->filter($builder);
    }

    public function transactionable()
    {
        return $this->morphTo('transactionable', 'transaction_type', 'transaction_id');
    }

    public function clearances()
    {
        return $this->belongsToMany(Clearance::class, 'clearance_transaction_event', 'transaction_event_id')->withTimestamps();
    }

    public function totalTransactionAmountByUser($id){
        $totalAmount = $this->where('user_id', $id)->sum("amount");
        $user = User::find($id);
        if($user){
            $user->totalAmount = $totalAmount;
        }
        return $user;
    }


    public function selectedMonthTransactions($year, $month, $transactionType)
    {
        return $this->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->whereTransactionType($transactionType)
            ->with('transactionable')
            ->get();
    }

    public function refundTransaction()
    {
        return $this->hasOne(LoadTestFund::class, 'pre_transaction_id', 'pre_transaction_id');
    }

}
