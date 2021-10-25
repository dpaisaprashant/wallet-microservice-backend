<?php

namespace App\Filters\MerchantTransactionEvent;

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

        return $builder->where('amount', '>=', (float)($value[0] * 100))->where('amount', '<=', (float)($value[1] * 100));
    }
}
