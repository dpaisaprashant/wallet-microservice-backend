<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceTransactionEvent extends Model
{

    protected $table = 'clearance_transaction_event';
    protected $connection = "dpaisa";

    protected $fillable =[
      'clearance_id',
      'transaction_event_id'
    ];
}
