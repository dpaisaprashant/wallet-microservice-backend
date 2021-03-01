<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use App\Models\TransactionEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SortFilter extends FilterAbstract {


    public function mapping()
    {
        return [

        ];
    }

    /**
     * Apply filter.
     *
     * @param Builder $builder
     * @param mixed $value
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value)
    {
        //$value = $this->resolveFilterValue($value);
        if ($value === null) {
            return $builder;
        }

        if ($value === 'transaction_number') {

            return $builder->withCount('userTransactionEvents')->orderBy('user_transaction_events_count', 'DESC');

        }else if ($value === 'wallet_balance') {

          /*  return $builder->join('wallets', 'wallets.user_id', '=', 'users.id')
                ->orderBy('wallets.balance', 'DESC');*/

          return $builder;

        }else if ($value === 'transaction_payment') {

            return $builder->get()->map(function ($value,$key){
                $value["totalAmount"] = $value->totalTransactionAmount();
                return $value;
            })->sortByDesc("totalAmount");

        //return $builder->userTransactionEvents->totalTransactionAmountByUser();
        }




    }
}
