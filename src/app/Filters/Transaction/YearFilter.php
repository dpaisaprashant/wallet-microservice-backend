<?php

namespace App\Filters\Transaction;

use App\Filters\FilterAbstract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class YearFilter extends FilterAbstract {


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

            $now = Carbon::now();
            $year = $now->format('Y');

            return $builder->whereYear('created_at', '=', $year);
        }


        return $builder->whereYear('created_at', '=', $value);
    }
}
