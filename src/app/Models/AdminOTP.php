<?php

namespace App\Models;

use App\Wallet\OTP\Traits\OTPToken;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminOTP extends Model
{

    use OTPToken, SoftDeletes;

    protected $table = 'admin_o_t_p_s';
    protected $connection = 'mysql';

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function checkValidToken($token)
    {
        return $this->where('token', $token)->where('expires_on', '>=', now()->toDateTimeString())->first();
    }
}
