<?php

namespace App\Filters\UserKyc;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ChangeStatusFilter extends FilterAbstract {

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


        if($value == "accepted"){
            return $builder->where('accept','1');
        }elseif($value == "rejected"){
            return $builder->where('accept','0');
        }elseif($value == "notverified"){
            return $builder->where('accept',null);
        }elseif($value == "all"){
            return $builder->where('id','!=',null);
        }

    }
}
