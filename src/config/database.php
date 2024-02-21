<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'dpaisa' => [
            'driver' => 'mysql',
            'url' => env('DATABASE2_URL'),
            'host' => env('DB2_HOST', '127.0.0.1'),
            'port' => env('DB2_PORT', '3306'),
            'database' => env('DB2_DATABASE', 'forge'),
            'username' => env('DB2_USERNAME', 'forge'),  
            'password' => env('DB2_PASSWORD', ''),
            'unix_socket' => env('DB2_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],


        'merchant' => [
            'driver' => 'mysql',
            'url' => env('DATABASE3_URL'),
            'host' => env('DB3_HOST', '127.0.0.1'),
            'port' => env('DB3_PORT', '3306'),
            'database' => env('DB3_DATABASE', 'forge'),
            'username' => env('DB3_USERNAME', 'forge'),
            'password' => env('DB3_PASSWORD', ''),
            'unix_socket' => env('DB3_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'paypoint' => [
            'driver' => 'mysql',
            'url' => env('DATABASE4_URL'),
            'host' => env('DB4_HOST', '127.0.0.1'),
            'port' => env('DB4_PORT', '3306'),
            'database' => env('DB4_DATABASE', 'forge'),
            'username' => env('DB4_USERNAME', 'forge'),
            'password' => env('DB4_PASSWORD', ''),
            'unix_socket' => env('DB4_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'nchl' => [
            'driver' => 'mysql',
            'url' => env('DATABASE5_URL'),
            'host' => env('DB5_HOST', '127.0.0.1'),
            'port' => env('DB5_PORT', '3306'),
            'database' => env('DB5_DATABASE', 'forge'),
            'username' => env('DB5_USERNAME', 'forge'),
            'password' => env('DB5_PASSWORD', ''),
            'unix_socket' => env('DB5_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'nicasia' => [
            'driver' => 'mysql',
            'url' => env('DATABASE6_URL'),
            'host' => env('DB6_HOST', '127.0.0.1'),
            'port' => env('DB6_PORT', '3306'),
            'database' => env('DB6_DATABASE', 'forge'),
            'username' => env('DB6_USERNAME', 'forge'),
            'password' => env('DB6_PASSWORD', ''),
            'unix_socket' => env('DB6_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'ntc' => [
            'driver' => 'mysql',
            'url' => env('DATABASE7_URL'),
            'host' => env('DB7_HOST', '127.0.0.1'),
            'port' => env('DB7_PORT', '3306'),
            'database' => env('DB7_DATABASE', 'forge'),
            'username' => env('DB7_USERNAME', 'forge'),
            'password' => env('DB7_PASSWORD', ''),
            'unix_socket' => env('DB7_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'npay' => [
            'driver' => 'mysql',
            'url' => env('DATABASE8_URL'),
            'host' => env('DB8_HOST', '127.0.0.1'),
            'port' => env('DB8_PORT', '3306'),
            'database' => env('DB8_DATABASE', 'forge'),
            'username' => env('DB8_USERNAME', 'forge'),
            'password' => env('DB8_PASSWORD', ''),
            'unix_socket' => env('DB8_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'nps' => [
            'driver' => 'mysql',
            'url' => env('DATABASE9_URL'),
            'host' => env('DB9_HOST', '127.0.0.1'),
            'port' => env('DB9_PORT', '3306'),
            'database' => env('DB9_DATABASE', 'forge'),
            'username' => env('DB9_USERNAME', 'forge'),
            'password' => env('DB9_PASSWORD', ''),
            'unix_socket' => env('DB9_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'bfi' => [
            'driver' => 'mysql',
            'url' => env('DATABASE10_URL'),
            'host' => env('DB10_HOST', '127.0.0.1'),
            'port' => env('DB10_PORT', '3306'),
            'database' => env('DB10_DATABASE', 'forge'),
            'username' => env('DB10_USERNAME', 'forge'),
            'password' => env('DB10_PASSWORD', ''),
            'unix_socket' => env('DB10_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'khalti' => [
            'driver' => 'mysql',
            'url' => env('DATABASE11_URL'),
            'host' => env('DB11_HOST', '127.0.0.1'),
            'port' => env('DB11_PORT', '3306'),
            'database' => env('DB11_DATABASE', 'forge'),
            'username' => env('DB11_USERNAME', 'forge'),
            'password' => env('DB11_PASSWORD', ''),
            'unix_socket' => env('DB11_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        // 'flight' => [
        //     'driver' => 'mysql',
        //     'url' => env('DATABASE999_URL'),
        //     'host' => env('DB999_HOST', '127.0.0.1'),
        //     'port' => env('DB999_PORT', '3306'),
        //     'database' => env('DB999_DATABASE', 'forge'),
        //     'username' => env('DB999_USERNAME', 'forge'),
        //     'password' => env('DB999_PASSWORD', ''),
        //     'unix_socket' => env('DB999_SOCKET', ''),
        //     'charset' => 'utf8mb4',
        //     'collation' => 'utf8mb4_unicode_ci',
        //     'prefix' => '',
        //     'prefix_indexes' => true,
        //     'strict' => false,
        //     'engine' => null,
        //     'options' => extension_loaded('pdo_mysql') ? array_filter([
        //         PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        //     ]) : [],
        //     'dump' => [
        //         'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
        //         'use_single_transaction',
        //         'timeout' => 60 * 5, // 5 minute timeout
        //     ]
        // ],

        'cellpay' => [
            'driver' => 'mysql',
            'url' => env('DATABASE12_URL'),
            'host' => env('DB12_HOST', '127.0.0.1'),
            'port' => env('DB12_PORT', '3306'),
            'database' => env('DB12_DATABASE', 'forge'),
            'username' => env('DB12_USERNAME', 'forge'),
            'password' => env('DB12_PASSWORD', ''),
            'unix_socket' => env('DB12_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'clearance' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_CLEARANCE_URL'),
            'host' => env('DB_HOST_CLEARANCE', '127.0.0.1'),
            'port' => env('DB_PORT_CLEARANCE', '3306'),
            'database' => env('DB_DATABASE_CLEARANCE', 'forge'),
            'username' => env('DB_USERNAME_CLEARANCE', 'forge'),
            'password' => env('DB_PASSWORD_CLEARANCE', ''),
            'unix_socket' => env('DB_CLEARANCE_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'paymentnepal' => [
            'driver' => 'mysql',
            'url' => env('DATABASE13_URL'),
            'host' => env('DB13_HOST', '127.0.0.1'),
            'port' => env('DB13_PORT', '3306'),
            'database' => env('DB13_DATABASE', 'forge'),
            'username' => env('DB13_USERNAME', 'forge'),
            'password' => env('DB13_PASSWORD', ''),
            'unix_socket' => env('DB13_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'nps-accountlink' => [
            'driver' => 'mysql',
            'url' => env('DATABASE14_URL'),
            'host' => env('DB14_HOST', '127.0.0.1'),
            'port' => env('DB14_PORT', '3306'),
            'database' => env('DB14_DATABASE', 'forge'),
            'username' => env('DB14_USERNAME', 'forge'),
            'password' => env('DB14_PASSWORD', ''),
            'unix_socket' => env('DB14_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'merchant-checkout' => [
            'driver' => 'mysql',
            'url' => env('DATABASE15_URL'),
            'host' => env('DB15_HOST', '127.0.0.1'),
            'port' => env('DB15_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'forge'),
            'username' => env('DB15_USERNAME', 'forge'),
            'password' => env('DB15_PASSWORD', ''),
            'unix_socket' => env('DB15_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'nea' => [
            'driver' => 'mysql',
            'url' => env('DATABASE16_URL'),
            'host' => env('DB16_HOST', '127.0.0.1'),
            'port' => env('DB16_PORT', '3306'),
            'database' => env('DB16_DATABASE', 'forge'),
            'username' => env('DB16_USERNAME', 'forge'),
            'password' => env('DB16_PASSWORD', ''),
            'unix_socket' => env('DB16_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'fixture-tickets' => [
            'driver' => 'mysql',
            'url' => env('DATABASE17_URL'),
            'host' => env('DB17_HOST', '127.0.0.1'),
            'port' => env('DB17_PORT', '3306'),
            'database' => env('DB17_DATABASE', 'forge'),
            'username' => env('DB17_USERNAME', 'forge'),
            'password' => env('DB17_PASSWORD', ''),
            'unix_socket' => env('DB17_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'event-tickets' => [
            'driver' => 'mysql',
            'url' => env('DATABASE18_URL'),
            'host' => env('DB18_HOST', '127.0.0.1'),
            'port' => env('DB18_PORT', '3306'),
            'database' => env('DB18_DATABASE', 'forge'),
            'username' => env('DB18_USERNAME', 'forge'),
            'password' => env('DB18_PASSWORD', ''),
            'unix_socket' => env('DB18_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'magnus' => [
            'driver' => 'mysql',
            'url' => env('DATABASE16_URL'),
            'host' => env('DB19_HOST', '127.0.0.1'),
            'port' => env('DB19_PORT', '3306'),
            'database' => env('DB19_DATABASE', 'forge'),
            'username' => env('DB19_USERNAME', 'forge'),
            'password' => env('DB19_PASSWORD', ''),
            'unix_socket' => env('DB19_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'swipe_voting' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_SWIPE_VOTING_URL'),
            'host' => env('DB_HOST_SWIPE_VOTING', '127.0.0.1'),
            'port' => env('DB_PORT_SWIPE_VOTING', '3306'),
            'database' => env('DB_DATABASE_SWIPE_VOTING', 'forge'),
            'username' => env('DB_USERNAME_SWIPE_VOTING', 'forge'),
            'password' => env('DB_PASSWORD_SWIPE_VOTING', ''),
            'unix_socket' => env('DB_SWIPE_VOTING_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
            'dump' => [
                'dump_binary_path' => env('DB_DUMP_PATH', '/usr/bin/'), // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ]
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        'mongodb' => [
            'driver' => 'mongodb',
            'dsn' => env('MONGO_DSN', ''),
            'database' => env('MONGO_DATABASE', ''),
        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
