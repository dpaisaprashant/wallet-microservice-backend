<?php

namespace App\Models\Merchant;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MerchantProduct extends Model
{
    protected $connection = 'dpaisa';
    protected $table = 'merchant_products';

    protected $fillable = [
        'type',
        'json_data',
        'merchant_id'
    ];

    protected $casts = [

    ];


    public function rules(){
        $rules = array(
            'merchant_id' => 'required|unique:dpaisa.merchant_products',
        );
        return $rules;
    }

    public function merchantProductUsers(){
        return $this->hasOne(Merchant::class,'id','merchant_id',);
    }
}
