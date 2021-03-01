<?php

namespace App\Filters\ApiLog;

use App\Filters\FilterAbstract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class CheckPaymentIdFilter extends FilterAbstract {


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
        return $builder->where('check_payment_id', $value);

    }
}
