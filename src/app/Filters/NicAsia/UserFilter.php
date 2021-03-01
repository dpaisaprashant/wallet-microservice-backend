<?php

namespace App\Filters\NicAsia;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends FilterAbstract {


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

        return $builder->whereHas('user', function ($query) use ($value){
            $query->where(function ($query) use ($value) {
                $query->where('email', $value)->orWhere('mobile_no', $value);
            });
        });
    }
}
