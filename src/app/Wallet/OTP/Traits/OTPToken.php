<?php

namespace App\Wallet\OTP\Traits;


use App\Models\AdminOTP;
use Illuminate\Support\Facades\Config;

trait OTPToken
{
    /**
     * @param $length
     * @return int
     *
     * @throws \Exception
     */
    private function generateToken($length)
    {
        $minValue = str_pad(1, $length, 0);
        $maxValue = str_pad(9, $length, 9);
        return random_int($minValue, $maxValue);
    }

    private function removeExpired($otps){
        return $otps->map(function($value) {
            if(\Carbon\Carbon::parse($value->expires_on) < now()) return $value->delete();
        });
    }

    /**
     * @return bool
     */
    public function removeExpiredTokens()
    {
        $otps = $this->get();
        $this->removeExpired($otps);
        return true;
    }


    /**
     * @param $adminId
     * @param $length
     * @return $this
     */
    public function generate($adminId, $length)
    {

        try {
            $this->removeExpiredTokens();
            $this->token = $this->generateToken($length);
            $this->admin_id = $adminId;
            $this->expires_on = now()->addMinutes(Config::get('admin-otp.expiry'));
            $this->save();
            return $this;

        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * @param $adminId
     * @return mixed
     */
    public function getTriesCount($adminId)
    {
        return AdminOTP::where('admin_id', $adminId)->count();
    }

    protected function validToken($token)
    {
        return $this->with('admin')->whereToken($token)
            ->whereDate('expires_on', '>=', now())
            ->first();

    }

    /**
     * @param $token
     * @return bool
     */
    public function userByToken($token)
    {
        $otp = $this->validToken($token);
        if ($otp) {
            return $otp->user;
        }
        return false;
    }
}
