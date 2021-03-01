<?php

return [
    // Types of users will be listed here
    // Acts as the key of setting table
    "load" => [
        "daily" => "load_daily_limit",
        "daily_verified" => "load_daily_verified_limit",
        "monthly" => "load_monthly_limit",
        "monthly_verified" => "load_monthly_verified_limit",
        "transaction" => "load_transaction_limit",
        "transaction_verified" => "load_transaction_verified_limit",
    ],
    "payment" => [
        "daily" => "payment_daily_limit",
        "daily_verified" => "payment_daily_verified_limit",
        "monthly" => "payment_monthly_limit",
        "monthly_verified" => "payment_monthly_verified_limit",
        "transaction" => "payment_transaction_limit",
        "transaction_verified" => "payment_transaction_verified_limit",
    ],
    "transfers" => [
        "daily" => "transfers_daily_limit",
        "daily_verified" => "transfers_daily_verified_limit",
        "monthly" => "transfers_monthly_limit",
        "monthly_verified" => "transfers_monthly_verified_limit",
        "transaction" => "transfers_transaction_limit",
        "transaction_verified" => "transfers_transaction_verified_limit",
    ],
    "card_sct" => [
        "daily" => "sct_daily_limit",
        "daily_verified" => "sct_daily_verified_limit",
        "monthly" => "sct_monthly_limit",
        "monthly_verified" => "sct_monthly_verified_limit",
        "transaction" => "sct_transaction_limit",
        "transaction_verified" => "sct_transaction_verified_limit",
    ],
    "bank-transfer" => [
        "daily" => "bank_transfer_daily_limit",
        "daily_verified" => "bank_transfer_daily_verified_limit",
        "monthly" => "bank_transfer_monthly_limit",
        "monthly_verified" => "bank_transfer_monthly_verified_limit",
        "transaction" => "bank_transfer_transaction_limit",
        "transaction_verified" => "bank_transfer_transaction_verified_limit",
    ],

    // Set the amount limit default value here
    "values" => [
        "load" => [
            "daily" => 500000,
            "daily_verified" => 2500000,
            "monthly" => 2000000,
            "monthly_verified" => 10000000,
            "transaction" => 500000,
            "transaction_verified" => 2500000,
        ],
        "payment" => [
            "daily" => 500000,
            "daily_verified" => 100000000,
            "monthly" => 2000000,
            "monthly_verified" => 5000000000,
            "transaction" => 500000,
            "transaction_verified" => 100000000,
        ],
        "transfers" => [
            "daily" => 500000,
            "daily_verified" => 2500000,
            "monthly" => 1000000,
            "monthly_verified" => 5000000,
            "transaction" => 500000,
            "transaction_verified" => 2500000,
        ],
        "card_sct" => [
            "daily" => 500000,
            "daily_verified" => 5000000,
            "monthly" => 3000000,
            "monthly_verified" => 500000000,
            "transaction" => 500000,
            "transaction_verified" => 5000000,
        ],
        "bank-transfer" => [
            "daily" => 500000,
            "daily_verified" => 2500000,
            "monthly" => 2000000,
            "monthly_verified" => 5000000,
            "transaction" => 500000,
            "transaction_verified" => 2500000,
        ],
    ]
];
