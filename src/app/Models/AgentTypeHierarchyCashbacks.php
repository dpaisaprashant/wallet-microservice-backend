<?php

namespace App\Models;

use App\Models\Architecture\WalletTransactionTypeCashback;
use Illuminate\Database\Eloquent\Model;

class AgentTypeHierarchyCashbacks extends Model
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


}
