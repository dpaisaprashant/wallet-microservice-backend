<?php


namespace App\Filters\User;


use App\Filters\FilterAbstract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class UserActivityStatusFilter extends FilterAbstract
{
    private string $sixMonthBeforeToDate;
    private string $twelveMonthBeforeToDate;

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
    public function filter(Builder $builder, $value){

        if ($value === null) {
            return $builder;
        }

        $request = request()->all();
        if (! isset($request['transaction_to'])) {
            $date = date('Y-m-d');
        }
        $date = date('Y-m-d', strtotime(str_replace(',', ' ', $request['transaction_to'])));

        $this->sixMonthBeforeToDate = Carbon::parse($date)->subMonths(6)->endOfDay()->toDateTimeString();
        $this->twelveMonthBeforeToDate = Carbon::parse($date)->subMonths(12)->endOfDay()->toDateTimeString();

        if ($value == "active"){
            return $builder->whereHas('latestLoginAttempt', function ($query) {
                return $query->where('created_at', '>=', $this->sixMonthBeforeToDate);
            });
        }
        elseif ($value == "inactive_6_month"){
            return $builder->whereHas('latestLoginAttempt', function ($query) {
                return $query->where('created_at', '<', $this->sixMonthBeforeToDate)
                    ->where('created_at', '>=', $this->twelveMonthBeforeToDate);
            });
        }
        else if ($value == "inactive_12_month"){
            return $builder->whereHas('latestLoginAttempt', function ($query) {
                return $query->where('created_at', '<', $this->twelveMonthBeforeToDate);
            })->orDoesntHave('latestLoginAttempt');
        }
    }
}
