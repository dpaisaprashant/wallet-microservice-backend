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

        return $builder->where('admin_user_k_y_c.status', strtoupper($value));
    }
}
