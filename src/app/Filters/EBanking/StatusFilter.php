<?php

namespace App\Filters\EBanking;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter extends FilterAbstract {

    public function mapping()
    {
        return [
            'completed' => 'COMPLETED',
            'validated' => 'VALIDATED'
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
