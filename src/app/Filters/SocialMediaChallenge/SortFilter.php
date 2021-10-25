<?php

namespace App\Filters\MerchantTransactionEvent;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class SortFilter extends FilterAbstract {


    public function mapping()
    {
        return [
            'date' => 'created_at',
            'amount' => 'amount',
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

        if ($value == 'debit') {
            return $builder->orderBy($value, 'DESC');
        }elseif ($value == 'credit') {

        }

        return $builder->orderBy($value, 'DESC');
    }
}
