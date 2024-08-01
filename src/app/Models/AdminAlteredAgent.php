<?php

namespace App\Models;

use App\Filters\AdminAlteredAgent\AdminAlteredAgentFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdminAlteredAgent extends Model
{
    protected $connection = 'mysql';
    protected $guarded = [];
    protected $table = 'admin_altered_agents';

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function agent(){
        return $this->belongsTo(Agent::class,'agent_id');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new AdminAlteredAgentFilters($request))->add($filters)->filter($builder);
    }
}
