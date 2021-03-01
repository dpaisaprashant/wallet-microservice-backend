<?php

namespace App\Filters\Dispute;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class VendorAmountFilter extends FilterAbstract {


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

        return $builder->where('vendor_amount', '>=', (float)($value[0] * 100))->where('vendor_amount', '<=', (float)($value[1] * 100));
    }
}
