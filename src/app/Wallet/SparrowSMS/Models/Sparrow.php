<?php

namespace App\Wallet\SparrowSMS\Models;

use Illuminate\Database\Eloquent\Model;

class Sparrow extends Model
{
    protected $guarded = [];

    protected $connection='dpaisa';

    protected $table  = "sparrow_sms";

}
