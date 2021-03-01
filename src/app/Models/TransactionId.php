<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionId extends Model
{
    protected $connection = 'dpaisa';

    const UPDATED_AT = null;
    protected $fillable = ["transaction_id"];
    public $timestamps = ['created_at'];

    public function createTransaction($transactionId){
        return $this->create(['transaction_id' => $transactionId]);
    }
}
