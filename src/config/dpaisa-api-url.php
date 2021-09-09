<?php
/**
 * This file sets url from dpaisa API
 */

return [
    'kyc_documentation_url' => env('KYC_DOCUMENTATION_URL', 'https://dpaisa.com/storage/img/kyc/'),

    'admin_documentation_url' => env('ADMIN_DOCUMENTATION_URL','https://api.sajilopay.com.np/storage/img/agent/'),

    'agent_url' => env('AGENT_URL', 'https://api.dpaisa.com/storage/img/agent/'),

    'merchant_kyc_documentation_url' => env('MERCHANT_KYC_DOCUMENTATION_URL', 'https://staging.merchant.silkinv.com/storage/img/kyc/'),

    'public_document_url' => env('PUBLIC_DOCUMENTATION_URL','https://dpaisa.com/storage/')
];

