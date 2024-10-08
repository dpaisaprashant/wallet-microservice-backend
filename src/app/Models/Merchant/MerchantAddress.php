<?php

namespace App\Models\Merchant;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;

class MerchantAddress extends Model
{
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'User';

    protected $connection = 'dpaisa';
    protected $table = 'merchant_addresses';

    protected $fillable = [
        'location_id',
        'merchant_id',
    ];

    protected $casts = [

    ];


    public function rules(){
        $rules = array(
            'merchant_id' => 'required|unique:dpaisa.merchant_addresses',
        );
        return $rules;
    }

    public function merchantAddressUsers(){
        return $this->hasOne(Merchant::class,'id','merchant_id',);
    }

    public function merchantAddressLocation(){
        return $this->belongsTo(Location::class,'location_id','id',);
    }
}
