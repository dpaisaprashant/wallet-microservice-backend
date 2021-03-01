<?php


namespace App\Wallet\OTP;


use App\Models\AdminOTP;
use Illuminate\Support\Facades\Config;

class OTPGenerator
{
    private $model;

    public function __construct()
    {
        $this->model = new AdminOTP();
    }

    public function generate($adminId)
    {
        //remove expired tokens
        $this->model->removeExpiredTokens();
        //fetch if token is present
        $otp = $this->model->where('admin_id', $adminId)->first();

        if ($otp) {
            return $otp;
        }
        //if not generate new token
        $otp = $this->model->generate($adminId, Config::get('admin-otp.size'));
        return $otp;
    }

    public function delete($code, $id)
    {
        $this->model->where('token', $code)->where('id', $id)->delete();
        return true;
    }
}
