<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentType extends Model
{
    protected $connection = 'dpaisa';

    protected $guarded = [];

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
}
