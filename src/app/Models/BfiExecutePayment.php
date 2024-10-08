<?php

namespace App\Models;

use App\Filters\Agent\AgentFilters;
use App\Filters\BFI\BFIFilters;
use App\Filters\FiltersAbstract;
use App\Models\BFI\BFIUser;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BfiExecutePayment extends Model
{
    use BelongsToUser;

    protected $connection = "bfi";

    protected $guarded = [];

    protected $table = 'bfi_gateway_execute_payments';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = "bfi_gateway_execute_payments";
        $this->connection = "bfi";
    }

    public function getAmountAttribute($amount){
        return ($amount/100);
    }

    public function bfiUser(){
        return $this->belongsTo(BFIUser::class, 'user_id');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new BFIFilters($request))->add($filters)->filter($builder);
    }

}
