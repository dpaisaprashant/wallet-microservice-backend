<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'Your FCM server key'),
        'sender_id' => env('FCM_SENDER_ID', 'Your sender id'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],

    'topics' => [
        'kyc_unfilled' =>  'user_kyc_unfilled',
        'kyc_unverified' =>  'user_kyc_unverified',
        'kyc_verfied' =>  'user_kyc_verified'
    ],

    'districts' => [
        "Bhojpur",
        "Dhankuta",
        "Ilam",
        "Jhapa",
        "Khotang",
        "Morang",
        "Okhaldhunga",
        "Panchthar",
        "Sankhuwasabha",
        "Solukhumbu",
        "Sunsari",
        "Taplejung",
        "Terhathum",
        "Udayapur",
        "Bara",
        "Parsa",
        "Dhanusa",
        "Mahottari",
        "Rautahat",
        "Saptari",
        "Sarlahi",
        "Siraha",
        "Bhaktapur",
        "Chitwan",
        "Dhading",
        "Dolakha",
        "Kathmandu",
        "Kavrepalanchok",
        "Lalitpur",
        "Makwanpur",
        "Nuwakot",
        "Ramechhap",
        "Rasuwa",
        "Sindhuli",
        "Sindhupalchok",
        "Baglung",
        "Gorkha",
        "Kaski",
        "Lamjung",
        "Manang",
        "Mustang",
        "Myagdi",
        "Nawalparasi (East)",
        "Nawalparasi (West)",
        "Parbat",
        "Syangja",
        "Tanahun",
        "Arghakhanchi",
        "Banke",
        "Bardiya",
        "Dang Deukhuri",
        "Rukum (East)",
        "Gulmi",
        "Kapilvastu",
        "Palpa",
        "Pyuthan",
        "Rolpa",
        "Rupandehi",
        "Dailekh",
        "Dolpa",
        "Humla",
        "Jajarkot",
        "Jumla",
        "Kalikot",
        "Mugu",
        "Salyan",
        "Surkhet",
        "Rukum (West)",
        "Achham",
        "Achham",
        "Achham",
        "Baitadi",
        "Bajhang",
        "Bajura",
        "Dadeldhura",
        "Darchula",
        "Doti",
        "Kailali",
        "Kanchanpur"
    ]
];
