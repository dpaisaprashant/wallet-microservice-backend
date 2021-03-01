<?php

namespace App\Filters\UserTransaction;

use App\Filters\FilterAbstract;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter extends FilterAbstract {

    public function mapping()
    {
        return [
            'completed' => 'completed',
            'failed' => 'failed',
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

        $successfulTransactionId = UserTransaction::pluck('refStan')->all();

        if ($value == 'completed') {
            $builder->whereIn('refStan', $successfulTransactionId);
        } elseif ($value == 'failed') {
            $builder->whereNotIn('refStan', $successfulTransactionId);
        }

        return $builder;
    }
}
