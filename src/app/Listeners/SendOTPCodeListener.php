<?php

namespace App\Listeners;

use App\Notifications\OTPCodeGenerated;
use App\Wallet\OTP\OTPGenerator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOTPCodeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $request
     * @return void
     */
    public function handle($request)
    {
        $admin = $request->admin;
        $generator = new OTPGenerator();
        $otpCode = $generator->generate($admin->id);
        $admin->notify(new OTPCodeGenerated($otpCode, $admin));

    }
}
