<?php

namespace App\Filters\BFI;

use App\Filters\FilterAbstract;
use App\Models\BfiExecutePayment;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends FilterAbstract
{


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

        return $builder->with('bfiUser')->whereHas('bfiUser', function ($query) use ($value) {
            return $query->where('bfi_name', 'LIKE', "%{$value}%");
        });
    }


}
