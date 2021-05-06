<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Model;

class BfiGatewayExecutePayment extends Model
{
    use BelongsToUser, MorphOneTransaction;

    protected $connection = "bfi";
}
