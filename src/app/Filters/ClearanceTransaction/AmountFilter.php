<?php

namespace App\Filters\ClearanceTransaction;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class AmountFilter extends FilterAbstract {


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

        $value = explode(';' , $value);
        $value[0] = (int) $value[0];
        $value[1] = (int) $value[1];

        $transactions = $builder->with('clearanceable')->get();

        $clearanceTransactionIds =[];
        foreach ($transactions as $key => $transaction) {
            if($transaction->clearanceable->transactions['amount'] >= $value[0] && $transaction->clearanceable->transactions['amount'] <= $value[1] ) {
                array_push($clearanceTransactionIds, $transaction->id);
            }
        }

        return $builder->whereIn('id', $clearanceTransactionIds);
    }
}
