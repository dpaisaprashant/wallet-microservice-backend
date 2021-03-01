<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserLoadTransaction;

class LoadTransactionResponse extends Model
{
    protected $table = "load_transaction_responses";
    protected $connection = 'npay';


    public function userLoadTransaction()
    {
        return $this->belongsTo(UserLoadTransaction::class, 'load_id', 'id');
    }



}
