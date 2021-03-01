<?php

namespace App\Filters\FundRequest;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class RequestStatusFilter extends FilterAbstract {

    public function mapping()
    {
        return [
            'successful' => 1,
            'failed' => 0
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
        $value = $this->resolveFilterValue($this->mapping(), $value);
        if ($value === null) {
            return $builder;
        }

        return $builder->where('status', $value);
    }
}
