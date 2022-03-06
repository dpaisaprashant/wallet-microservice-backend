<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundWithdraw extends Model{

    protected $connection = 'dpaisa';
    protected $table = 'fund_withdraws';
}
