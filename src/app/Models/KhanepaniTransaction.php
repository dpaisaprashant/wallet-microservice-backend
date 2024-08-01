<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class KhanepaniTransaction extends Model
{
    protected $connection = 'dpaisa';
    protected $table = 'khanepani_transactions';
    protected $fillable = [
        'user_id',
        'transaction_type',
        'pre_transaction_id',
        'amount',
        'transaction_id',
        'transaction_data',
        'status',
    ];
             
}
