<?php

namespace App\Filters\ApiLog;

use App\Filters\FilterAbstract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ToDateFilter extends FilterAbstract {


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
        $date = date('Y-m-d', strtotime(str_replace(',', ' ', $value)));
        $date = Carbon::parse($date)->endOfDay()->format('Y-m-d H:m:s');

        return $builder->where('datetime', '<=', $date);

    }
}
