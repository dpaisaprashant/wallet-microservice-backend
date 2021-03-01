<?php

namespace App\Filters\ClearanceTransaction;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class VendorFilter extends FilterAbstract {


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

        $transactions = $builder->with('clearanceable')->get();

        $clearanceTransactionIds =[];
        foreach ($transactions as $key => $transaction) {
            if($transaction->clearanceable->transactions['vendor'] === $value ) {
                array_push($clearanceTransactionIds, $transaction->id);
            }
        }

        return $builder->whereIn('id', $clearanceTransactionIds);
    }
}
