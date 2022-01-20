<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagnusDeposit extends Model
{
    protected $connection = 'magnus';
    protected $table = 'magnus_cooperative_transaction';
}
