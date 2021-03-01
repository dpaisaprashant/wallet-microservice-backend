<?php

namespace App\Filters\FundRequest;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ResponseToDateFilter extends FilterAbstract {


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

        return $builder->where('response','!=', null)
            ->whereDate('updated_at', '<=' ,date('Y-m-d', strtotime(str_replace(',', ' ', $value))));

    }
}
