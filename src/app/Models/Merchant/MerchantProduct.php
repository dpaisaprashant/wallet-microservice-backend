<?php

namespace App\Models\Merchant;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;

class MerchantProduct extends Model
{
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'User';

    protected $connection = 'dpaisa';
    protected $table = 'merchant_products';

    protected $fillable = [
        'name',
        'price',
        'type',
        'service_charge',
        'description',
        'merchant_id',
    ];

    protected $casts = [

    ];


//    public function rules(){
//        $rules = array(
//            'merchant_id' => 'required|unique:dpaisa.merchant_products',
//        );
//        return $rules;
//    }

    public function merchant(){
        return $this->hasOne(Merchant::class,'id','merchant_id',);
    }
}
