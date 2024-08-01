<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\LinkedAccounts\LinkedAccountsFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Traits\BelongsToUser;

class LinkedAccounts extends Model
{
    use BelongsToUser;

    protected $connection = 'nps-accountlink';
    protected $table = "linked_accounts";

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new LinkedAccountsFilters($request))->add($filters)->filter($builder);
    }

}
