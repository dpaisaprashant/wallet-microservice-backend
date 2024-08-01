<?php

namespace App\Filters\Transaction;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
class TillFilter extends FilterAbstract {


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

        return \DB::connection('dpaisa')->select("SELECT transaction_events.balance FROM(SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at FROM transaction_events GROUP BY user_id HAVING created_at <= '2021-05-12 12:50:25') AS latest_transaction JOIN transaction_events ON transaction_events.created_at = latest_transaction.created_at AND transaction_events.id = latest_transaction.id AND transaction_events.user_id = latest_transaction.user_id");

    }
}
