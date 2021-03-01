<?php

namespace App\Filters\Clearance;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class TransactionCountFilter extends FilterAbstract {


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

        return $builder->where('total_transaction_count', '>=', ($value[0]))
            ->where('total_transaction_count', '<=', (int)($value[1]));
    }
}
