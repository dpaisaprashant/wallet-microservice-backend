<?php

namespace App\Filters\UserTransaction;

use App\Filters\FilterAbstract;
use App\Models\UserExecutePayment;
use App\Models\UserTransaction;
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

        if ($value[0] == 0 || $value[1] == 0) {
            $executedTransactions = UserTransaction::pluck('refStan')->all();

            return $builder->where( function ($query) use ($executedTransactions, $value) {
                $query->whereNotIn('refStan', $executedTransactions)
                    ->orWhereHas('userTransaction', function ($query) use ($value) {
                        $query->where('amount', '>=', (float)($value[0] * 100))->where('amount', '<=', (float)($value[1] * 100));
                    });
            });

        }


        return $builder->whereHas('userTransaction', function ($query) use ($value) {
           $query->where('amount', '>=', (float)($value[0] * 100))->where('amount', '<=', (float)($value[1] * 100));
        });
    }
}
