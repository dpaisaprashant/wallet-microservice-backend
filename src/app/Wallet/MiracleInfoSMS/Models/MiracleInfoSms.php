<?php

namespace App\Wallet\MiracleInfoSMS\Models;

use Illuminate\Database\Eloquent\Model;

class MiracleInfoSms extends Model
{
    protected $guarded = [];

    protected $connection='dpaisa';
    protected $table  = "miracle_info_sms";

}
