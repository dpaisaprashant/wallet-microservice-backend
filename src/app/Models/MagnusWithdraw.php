<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagnusWithdraw extends Model
{
    protected $connection = 'magnus';
    protected $table = 'magnus_withdraw_transaction';
}
