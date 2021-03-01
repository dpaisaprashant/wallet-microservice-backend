<?php

namespace App\Filters\Sparrow;

use App\Filters\FilterAbstract;
use App\Models\Clearance;
use Illuminate\Database\Eloquent\Builder;

class MobileNoFilter extends FilterAbstract {

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

        return $builder->where('mobile_no', $value);
    }
}
