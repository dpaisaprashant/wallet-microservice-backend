<?php

namespace App\Filters\UserTransaction;

use App\Filters\FilterAbstract;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class IdFilter extends FilterAbstract {


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
        if ($value === null) {
            return $builder;
        }

       /* $userTransaction = UserTransaction::where('refStan', $value)->first();

        $userLoadTransaction = UserLoadTransaction::where('transaction_id', $value)->first();

        if($userTransaction){
            $builder->where("transaction_id", $userTransaction->id)->where('transaction_type', '=', 'App\Models\UserTransaction');
        } elseif ($userLoadTransaction) {
            $builder->where("transaction_id", $userLoadTransaction->id)->where('transaction_type', '=', 'App\Models\UserLoadTransaction');
        }*/
        return $builder->where('transaction_id', $value);
    }
}
