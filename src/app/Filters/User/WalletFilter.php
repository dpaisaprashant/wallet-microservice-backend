<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class WalletFilter extends FilterAbstract {


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

        $value = explode(';' , $value);

        return $builder->whereHas('wallet', function ($query) use ($value) {
            $query->where('balance', '>=' , (float)($value[0] * 100))->where('balance', '<=', (float)($value[1] * 100));
        });
    }
}
