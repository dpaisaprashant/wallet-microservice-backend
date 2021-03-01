<?php

return [

    'url' => env('ONESIGNAL_URL', 'https://onesignal.com/api/v1/notifications'),

    'app_id' => env('ONESIGNAL_APP_ID', "8047c82e-b39a-45a7-98a7-12200d78888d"),

    'auth_code' => env('ONESIGNAL_AUTH_CODE', 'MGQ3ZWFhNTEtYTQ4Ny00NGFkLWEyYTAtNWNmMWI2MmIxOGFh'),

    'tags' => [
        'kyc_filled_users' => [
            'title' => 'kyc_filled_users',
            'filter' => [
                "field" => "tag",
                "key" => "kyc_status",
                "relation" => "=",
                "value" => "1"
            ]
        ],
        'kyc_rejected_users' => [
            'title' => 'kyc_rejected_users',
            'filter' => [
                "field" => "tag",
                "key" => "kyc_status",
                "relation" => "=",
                "value" => "-1"
            ]
        ],
        'kyc_unfilled_users' => [
            'title' => 'kyc_unfilled_users',
            'filter' => [
                "field" => "tag",
                "key" => "kyc_status",
                "relation" => "=",
                "value" => "0"
            ]
        ],
        'kyc_validated_users' => [
            'title' => 'kyc_validated_users',
            'filter' => [
                "field" => "tag",
                "key" => "kyc_status",
                "relation" => "=",
                "value" => "2"
            ]
        ],
    ]
];
