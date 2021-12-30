<?php


namespace App\Models;


use App\Models\Microservice\PreTransaction;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class MerchantRevenueRecord extends Model
{
    protected $guarded = [];

    protected $connection = 'dpaisa';

    use BelongsToUser;

    public function preTransaction(){
        return $this->belongsTo(PreTransaction::class,'pre_transaction_id','pre_transaction_id');
    }

    public function userTransactionEvent(){
        return $this->belongsTo(TransactionEvent::class,'user_transaction_event_id');
    }
}
