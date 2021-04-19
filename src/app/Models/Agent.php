<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use BelongsToUser;

    protected $connection = "dpaisa";

    protected $guarded = [];

    CONST STATUS_PROCESSING = 'PROCESSING';
    CONST STATUS_ACCEPTED = 'ACCEPTED';
    CONST STATUS_REJECTED = 'REJECTED';

    CONST INSTITUTION_TYPE_COMPANY = 'COMPANY';
    CONST INSTITUTION_TYPE_INDIVIDUAL = 'INDIVIDUAL';

    public function agentType()
    {
        return $this->belongsTo(AgentType::class, 'agent_type_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function codeUsed()
    {
        return $this->belongsTo(User::class, 'code_used_id');
    }
}
