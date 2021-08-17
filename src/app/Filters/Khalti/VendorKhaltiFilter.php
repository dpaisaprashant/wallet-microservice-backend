<?php

namespace App\Filters\Khalti;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class VendorKhaltiFilter extends FilterAbstract {


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
        if($value == 'All'){
            return $builder->where('vendor','!=',null);
        }
        return $builder->where('vendor',$value);

    }
}
