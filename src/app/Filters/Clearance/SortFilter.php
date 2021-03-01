<?php

namespace App\Filters\Clearance;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class SortFilter extends FilterAbstract {


    public function mapping()
    {
        return [
            'transaction_count' => 'total_transaction_count',
            'total_transaction_amount' => 'total_transaction_amount',
            'total_transaction_commission' => 'total_transaction_commission',
            'clearance_date' => 'created_at',
            'transaction_date' => 'transaction_date'
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
