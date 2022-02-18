<?php

namespace App\Filters\UserToBFIFundTransferFilter;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class TransactionIdFilter extends FilterAbstract {

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
        //$value = $this->resolveFilterValue($this->mapping(), $value);
        if ($value === null) {
            return $builder;
        }

        return $builder->where('transaction_id', $value);
    }
}
