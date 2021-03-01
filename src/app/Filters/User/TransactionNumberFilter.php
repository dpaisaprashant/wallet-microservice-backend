<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use App\Models\TransactionEvent;
use Illuminate\Database\Eloquent\Builder;

class TransactionNumberFilter extends FilterAbstract {


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

        if ($value[0] == 0 || $value[1] == 0) {

            $usersWithTransaction = TransactionEvent::groupBy('user_id')->pluck('user_id')->all();

            return $builder->where(function ($query) use ($usersWithTransaction, $value){
                $query->whereNotIn('id', $usersWithTransaction)
                    ->orWhereHas('userTransactionEvents', function ($query) use ($value) {
                        $query->groupBy('user_id')->havingRaw('COUNT(*) >= ' .  (int)$value[0] .' AND COUNT(*) <= '. (int)$value[1]);
                    });
            });
        }

        return $builder->whereHas('userTransactionEvents', function ($query) use ($value) {
            $query->groupBy('user_id')->havingRaw('COUNT(*) >= ' .  (int)$value[0] .' AND COUNT(*) <= '. (int)$value[1]);
        });
    }
}
