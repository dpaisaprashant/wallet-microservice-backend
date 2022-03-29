<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManualRefund extends Model
{

    protected $connection = "dpaisa";
    protected $table = "manual_refunds";
    protected $guarded = [];

}
