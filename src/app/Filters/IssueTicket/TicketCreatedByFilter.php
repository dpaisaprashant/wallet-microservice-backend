<?php

namespace App\Filters\IssueTicket;

use App\Filters\FilterAbstract;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;

class TicketCreatedByFilter extends FilterAbstract {

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

        $admin = Admin::with('issueTicket')->where('name','LIKE', "%{$value}%")->pluck('id');
        return $builder->whereIn('issued_by', $admin);
    }
}
