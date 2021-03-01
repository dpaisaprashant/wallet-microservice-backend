<?php

namespace App\Filters\UserLoginHistory;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ServerIpFilter extends FilterAbstract {


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

        return $builder->where('server_ip', '=', $value);
    }
}
