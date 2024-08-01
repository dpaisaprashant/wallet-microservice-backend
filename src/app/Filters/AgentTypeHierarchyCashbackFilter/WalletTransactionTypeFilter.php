<?php

namespace App\Filters\AgentTypeHierarchyCashbackFilter;

use App\Filters\FilterAbstract;
use App\Models\Architecture\AgentTypeHierarchyCashback;
use App\Models\Clearance;
use Illuminate\Database\Eloquent\Builder;

class WalletTransactionTypeFilter extends FilterAbstract {

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
        if ($value === null) {
            return $builder;
        }

        return $builder->where('wallet_transaction_type_id',$value);
    }
}
