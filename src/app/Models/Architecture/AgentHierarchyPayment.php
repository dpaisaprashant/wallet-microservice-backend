<?php

namespace App\Models\Architecture;

use App\Filters\AgentHierarchyPaymentFilter\AgentHierarchyPaymentFilters;
use App\Filters\FiltersAbstract;
use App\Models\Agent;
use App\Models\AgentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;

class AgentHierarchyPayment extends Model
{
    use LogsActivity;

    protected $connection = 'dpaisa';
    protected $table = 'agent_hierarchy_payments';

    protected $guarded = [];

    public function subAgent()
    {
        return $this->hasOne(User::class, 'id','sub_agent_id');
    }

    public function parentAgent()
    {
        return $this->hasOne(User::class, 'id','parent_agent_id');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new AgentHierarchyPaymentFilters($request))->add($filters)->filter($builder);
    }

}
