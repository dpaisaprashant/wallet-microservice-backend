<?php

namespace App\Filters\MiracleInfo;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class SortFilter extends FilterAbstract {


    public function mapping()
    {
        return [
            'date' => 'created_at',
            'rate' => 'rate',
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
            return $builder->latest();
        }

        return $builder->orderBy($value, 'DESC');
    }
}
