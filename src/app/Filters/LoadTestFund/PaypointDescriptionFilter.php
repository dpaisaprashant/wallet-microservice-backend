<?php

namespace App\Filters\LoadTestFund;

use App\Filters\FilterAbstract;
use App\Models\NchlBankTransfer;
use Illuminate\Database\Eloquent\Builder;

class PaypointDescriptionFilter extends FilterAbstract {


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


        return $builder->where('description', '=' , 'Paypoint Load');
    }
}
