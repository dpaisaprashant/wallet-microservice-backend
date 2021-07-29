<?php

namespace App\Models;

use App\Filters\Agent\AgentFilters;
use App\Filters\FiltersAbstract;
use App\Models\BFI\BFIUser;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BfiGatewayCheckPayment extends Model
{
    use BelongsToUser;

    protected $connection = "bfi";

    protected $guarded = [];

    protected $table = 'bfi_gateway_check_payments';



}
