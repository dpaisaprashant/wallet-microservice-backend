<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaypointToDpaisaTransaction extends Model
{
    protected $table = 'pay_point_to_dpaisa_clearance_transactions';
    protected $connection = 'dpaisa';
}
