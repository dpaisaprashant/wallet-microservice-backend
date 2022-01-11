<?php

namespace App\Models;

use App\Models\Architecture\WalletTransactionTypeCashback;
use Illuminate\Database\Eloquent\Model;

class AgentType extends Model
{
    protected $connection = 'dpaisa';

    protected $guarded = [];

    protected $subAgentTypeList = [];

    protected AgentType $currentAgentType;

    public function agents()
    {
        return $this->hasMany(Agent::class, 'agent_type_id');
    }

    public function subAgentTypes()
    {
        return $this->hasMany(AgentType::class, 'agent_type_id');
    }

    public function parentAgentType()
    {
        return $this->belongsTo(AgentType::class, 'agent_type_id');
    }

    public function walletTransactionTypeCashbacks()
    {
        return $this->morphMany(WalletTransactionTypeCashback::class, 'transactionCashbackable' , 'user_type', 'user_type_id');
    }

    public function agentTypeHierarchyCashbacks()
    {
        return $this->hasMany(AgentTypeHierarchyCashbacks::class);
    }

    public function getAllParentAgentTypes()
    {
        $this->currentAgentType = count($this->subAgentTypeList) == 0 ? $this : $this->subAgentTypeList[count($this->subAgentTypeList) -1];
        if ($this->currentAgentType->parentAgentType()->first()) {
            array_push($this->subAgentTypeList, $this->currentAgentType->parentAgentType()->first());
            self::getAllParentAgentTypes();
        }
        return $this->subAgentTypeList;
    }

    public function getAllSubAgentTypes()
    {
        $this->currentAgentType = count($this->subAgentTypeList) == 0 ? $this : $this->subAgentTypeList[count($this->subAgentTypeList) -1];
        if ($this->currentAgentType->subAgentTypes()->first()) {
            array_push($this->subAgentTypeList, $this->currentAgentType->subAgentTypes()->first());
            self::getAllSubAgentTypes();
        }
        return $this->subAgentTypeList;
    }
}
