<?php

namespace App\Filters\NchlBankTransfer;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class CreditStatusFilter extends FilterAbstract {

    public function mapping()
    {

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
        //$value = $this->resolveFilterValue($this->mapping(), $value);
        if ($value === null) {
            return $builder;
        }

        if ($value == "NOT_COMPLETED") {
            return $builder->where('credit_response_message', '!=', 'SUCCESS')
                ->where('credit_response_message', '!=', 'ERROR');
        }

        return $builder->where('credit_response_message', $value);
    }
}
