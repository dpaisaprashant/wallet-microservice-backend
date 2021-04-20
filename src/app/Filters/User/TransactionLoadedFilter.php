<?php


namespace App\Filters\User;


use App\Filters\FilterAbstract;
use App\Models\TransactionEvent;
use App\Models\UserLoadTransaction;
use Illuminate\Database\Eloquent\Builder;

class TransactionLoadedFilter extends FilterAbstract
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

        if ($value === null) {
            return $builder;
        }

        $value = explode(';' , $value);

        if ($value[0] == 0 || $value[1] == 0) {

            //$usersWithTransaction = UserLoadTransaction::groupBy('user_id')->pluck('user_id')->all();
            $usersWithTransaction = TransactionEvent::groupBy('user_id')->pluck('user_id')->all();

            return $builder->where(function ($query) use ($usersWithTransaction, $value){
                $query->whereNotIn('id', $usersWithTransaction)
                    ->orwhereHas('userLoadTransactions', function ($query) use ($value) {
                        $query->groupBy('user_id')->havingRaw('SUM(amount) >= ' .  (float)($value[0] * 100) .' AND SUM(amount) <= '. (float)($value[1] * 100));
                    });
            });
        }

        return $builder->whereHas('userTransactionEvents', function ($query) use ($value) {
            $query->groupBy('user_id')->havingRaw('SUM(amount) >= ' .  (float)($value[0] * 100) .' AND SUM(amount) <= '. (float)($value[1] * 100));
        });

    }
}
