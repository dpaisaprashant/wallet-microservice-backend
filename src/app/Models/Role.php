<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection = 'dpaisa';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function agentRole()
    {
        return $this->whereName('agent')->first();
    }
}
