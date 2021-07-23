<?php

namespace App\Models\BFI;

use App\Filters\Agent\AgentFilters;
use App\Filters\FiltersAbstract;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BFIUser extends Model
{
    use BelongsToUser;

    protected $connection = "bfi";

    protected $guarded = [];

    protected $table = 'users';

}
