<?php

namespace App\Filters\Transaction;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class DebitCreditFilter extends FilterAbstract {


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
        //$value = $this->resolveFilterValue($this->mapping(),$value);
        if ($value === null) {
            return $builder;
        }

        if ($value == 'true') {
            $operator = '=';
        }
        else {
            $operator = '!=';
        }

        return $builder->where('transaction_type',$operator, 'App\Models\UserTransaction');
    }
}
