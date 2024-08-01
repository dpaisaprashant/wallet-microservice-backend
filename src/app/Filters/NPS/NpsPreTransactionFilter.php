<?php

namespace App\Filters\NPS;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class NpsPreTransactionFilter extends FilterAbstract {


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
        return $builder->where('pre_transaction_id' ,$value);
    }
}
