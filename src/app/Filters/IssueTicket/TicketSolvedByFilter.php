<?php

namespace App\Filters\IssueTicket;

use App\Filters\FilterAbstract;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;

class TicketSolvedByFilter extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }

        $admin = Admin::with('issueTicket')->where('name','LIKE', "%{$value}%")->pluck('id');
        return $builder->whereIn('solved_by', $admin);
    }
}
