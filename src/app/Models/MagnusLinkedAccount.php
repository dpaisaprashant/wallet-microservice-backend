<?php

namespace App\Models;

use App\Filters\MagnusLinkedAccount\MagnusLinkedAccountFilters;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class MagnusLinkedAccount extends Model
{
    use BelongsToUser;
    protected $connection = 'magnus';
    protected $table = 'magnus_linked_accounts';



    public function scopeFilter(Builder $builder, Request $request, array $filters = []){
        return (new MagnusLinkedAccountFilters($request))->add($filters)->filter($builder);
    }
}
