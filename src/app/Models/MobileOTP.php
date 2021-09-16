<?php

namespace App\Models;

use App\Wallet\OTP\Traits\MobileOTPToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MobileOTP extends Model
{
//    use HasFactory, MobileOTPToken, Notifiable;

    protected $connection='dpaisa';
    protected $table='mobile_o_t_p_s';


}
