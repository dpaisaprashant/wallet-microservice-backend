<?php

namespace App\Wallet\AakashSMS\Models;

use Illuminate\Database\Eloquent\Model;

class AakashSMS extends Model
{
    protected $guarded = [];

    protected $connection='dpaisa';
    protected $table  = "aakash_smses";

}
