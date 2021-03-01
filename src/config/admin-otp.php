<?php
/**
 * This file sets the configuration for the OTP feature
 */

return [
    //Set the expiry time of OTP in minutes
    'expiry' => env("ADMIN_OTP_EXPIRY", 3),

    /**
     * Length of the otp
     */
    'size' => env('ADMIN_OTP_SIZE', 5),
];
