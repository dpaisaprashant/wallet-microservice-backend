<?php

namespace App\Filters\FundRequest;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ResponseStatusFilter extends FilterAbstract {

    public function mapping()
    {
        return [
            'accepted' => 1,
            'rejected' => 0,
            'pending' => 2
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

        if ($value == 2) {
            $value = null;
        }

        return $builder->where('response', $value);
    }
}
