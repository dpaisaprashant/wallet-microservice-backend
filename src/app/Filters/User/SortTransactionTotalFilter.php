<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use App\Models\TransactionEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SortTransactionTotalFilter extends FilterAbstract
{


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

        if (request()->sortTot) {
            dd('here');
            if ($value === 'total_credit_amount') {

//            dd($builder->whereHas('userTransactionEvents',function ($query){
//                return $query->orderByDesc('amount');
//            })->get());
//            return $builder->asd;

            } elseif ($value === 'total_debit_amount') {

            } elseif ($value === 'total_credit_count') {

            } elseif ($value === 'total_debit_count') {

            } elseif ($value === 'total_cashback_count') {

            } elseif ($value === 'total_cashback_amount') {

            } elseif ($value === 'total_commission_amount') {

            } elseif ($value === 'total_commission_count') {

            }
        }

    }
}
