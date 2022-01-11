<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    protected $connection = 'dpaisa';

    protected $table = 'schemes';

    protected $fillable = ['name','scheme_code','allow_cashback','allow_commission','validate_kyc','status'];
}
