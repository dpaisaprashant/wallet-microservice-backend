<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreTransaction extends Model
{
    protected $connection = 'dpaisa';
    protected $guarded = [];
    protected $table = 'pre_transactions';

}
