<?php

namespace App\Filters\UserKyc;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter extends FilterAbstract {

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

        if ($value == 'accepted') {
            $builder->where('user_k_y_c_s.status','=',1)->whereAccept(1);
        } elseif ($value == 'rejected') {
            $builder->where('user_k_y_c_s.status','=',0)->whereAccept(0);
        }

        return $builder;
    }
}
