<?php

namespace App\Models\Architecture;

use App\Filters\AgentTypeHierarchyCashbackFilter\AgentTypeHierarchyCashbackFilters;
use App\Filters\FiltersAbstract;
use App\Models\AgentType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AgentTypeHierarchyCashback extends Model
{
    protected $connection = 'dpaisa';

    protected $guarded = [];

    public function agentType()
    {
        return $this->belongsTo(AgentType::class,'agent_type_id');
    }

    public function parentAgentType()
    {
        return $this->belongsTo(AgentType::class, 'parent_agent_type_id');
    }

    public function walletTransactionType(){
        return $this->belongsTo(WalletTransactionType::class,'wallet_transaction_type_id');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new AgentTypeHierarchyCashbackFilters($request))->add($filters)->filter($builder);
    }

}
