<?php

namespace App\Models;

use App\Models\Architecture\WalletTransactionTypeCashback;
use Illuminate\Database\Eloquent\Model;

class AgentType extends Model
{
    protected $connection = 'dpaisa';

    protected $guarded = [];

    protected $subAgentTypeList = [];

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

    public function getAllSubAgentTypes()
    {
        if ($this->subAgentTypes()->first()) {
            array_push($this->subAgentTypeList, $this->subAgentTypes()->first());
            self::getAllSubAgentTypes();
        }
        return $this->subAgentTypeList;
    }
}
