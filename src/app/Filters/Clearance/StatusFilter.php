<?php

namespace App\Filters\Clearance;

use App\Filters\FilterAbstract;
use App\Models\Clearance;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter extends FilterAbstract {

    public function mapping()
    {
        return [
            'signed' => Clearance::STATUS_SIGNED,
            'cleared' => Clearance::STATUS_CLEARED
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
