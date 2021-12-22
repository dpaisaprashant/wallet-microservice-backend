<?php return array (
  'MiracleInfo-sms' => 
  array (
    'base_url' => 'http://api.miracleinfo.com.np',
    'url' => '/sms/smssend.php',
    'from' => 'dpaisa',
    'token' => 'G0!dm!neS3rv!c3',
    'tag' => 'BQ',
    'ac' => 'GmS301dP977PsPnp',
    'dt' => '20210627165900',
    'msg' => 'Test Message for dpaisa. Do not reply!!',
    's' => '1',
    'c' => '1',
  ),
  'UploadFilesToCore' => 
  array (
    'base_url' => 'nginx_core_wallet',
    'url' => '/api/backend/image',
  ),
  'activitylog' => 
  array (
    'enabled' => true,
    'delete_records_older_than_days' => 365,
    'default_log_name' => 'default',
    'default_auth_driver' => NULL,
    'subject_returns_soft_deleted_models' => false,
    'activity_model' => 'Spatie\\Activitylog\\Models\\Activity',
    'table_name' => 'activity_log',
    'database_connection' => NULL,
  ),
  'admin-otp' => 
  array (
    'expiry' => 3,
    'size' => 5,
  ),
  'amount-limits' => 
  array (
    'load' => 
    array (
      'daily' => 'load_daily_limit',
      'daily_verified' => 'load_daily_verified_limit',
      'monthly' => 'load_monthly_limit',
      'monthly_verified' => 'load_monthly_verified_limit',
      'transaction' => 'load_transaction_limit',
      'transaction_verified' => 'load_transaction_verified_limit',
    ),
    'payment' => 
    array (
      'daily' => 'payment_daily_limit',
      'daily_verified' => 'payment_daily_verified_limit',
      'monthly' => 'payment_monthly_limit',
      'monthly_verified' => 'payment_monthly_verified_limit',
      'transaction' => 'payment_transaction_limit',
      'transaction_verified' => 'payment_transaction_verified_limit',
    ),
    'transfers' => 
    array (
      'daily' => 'transfers_daily_limit',
      'daily_verified' => 'transfers_daily_verified_limit',
      'monthly' => 'transfers_monthly_limit',
      'monthly_verified' => 'transfers_monthly_verified_limit',
      'transaction' => 'transfers_transaction_limit',
      'transaction_verified' => 'transfers_transaction_verified_limit',
    ),
    'card_sct' => 
    array (
      'daily' => 'sct_daily_limit',
      'daily_verified' => 'sct_daily_verified_limit',
      'monthly' => 'sct_monthly_limit',
      'monthly_verified' => 'sct_monthly_verified_limit',
      'transaction' => 'sct_transaction_limit',
      'transaction_verified' => 'sct_transaction_verified_limit',
    ),
    'bank-transfer' => 
    array (
      'daily' => 'bank_transfer_daily_limit',
      'daily_verified' => 'bank_transfer_daily_verified_limit',
      'monthly' => 'bank_transfer_monthly_limit',
      'monthly_verified' => 'bank_transfer_monthly_verified_limit',
      'transaction' => 'bank_transfer_transaction_limit',
      'transaction_verified' => 'bank_transfer_transaction_verified_limit',
    ),
    'values' => 
    array (
      'load' => 
      array (
        'daily' => 500000,
        'daily_verified' => 2500000,
        'monthly' => 2000000,
        'monthly_verified' => 10000000,
        'transaction' => 500000,
        'transaction_verified' => 2500000,
      ),
      'payment' => 
      array (
        'daily' => 500000,
        'daily_verified' => 100000000,
        'monthly' => 2000000,
        'monthly_verified' => 5000000000,
        'transaction' => 500000,
        'transaction_verified' => 100000000,
      ),
      'transfers' => 
      array (
        'daily' => 500000,
        'daily_verified' => 2500000,
        'monthly' => 1000000,
        'monthly_verified' => 5000000,
        'transaction' => 500000,
        'transaction_verified' => 2500000,
      ),
      'card_sct' => 
      array (
        'daily' => 500000,
        'daily_verified' => 5000000,
        'monthly' => 3000000,
        'monthly_verified' => 500000000,
        'transaction' => 500000,
        'transaction_verified' => 5000000,
      ),
      'bank-transfer' => 
      array (
        'daily' => 500000,
        'daily_verified' => 2500000,
        'monthly' => 2000000,
        'monthly_verified' => 5000000,
        'transaction' => 500000,
        'transaction_verified' => 2500000,
      ),
    ),
  ),
  'app' => 
  array (
    'name' => 'master',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost/',
    'logo' => 'sajilopay',
    'core_url' => '',
    'asset_url' => NULL,
    'timezone' => 'Asia/Kathmandu',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:+m29NtQ0pP/byCZKy9S29sszaUsdJ7IpyYAT43OZG3Q=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'Spatie\\Permission\\PermissionServiceProvider',
      27 => 'LaravelFCM\\FCMServiceProvider',
      28 => 'Barryvdh\\Debugbar\\ServiceProvider',
      29 => 'App\\Wallet\\Report\\WalletReportServiceProvider',
      30 => 'App\\Wallet\\Referral\\ReferralServiceProvider',
      31 => 'App\\Wallet\\Merchant\\MerchantServiceProvider',
      32 => 'App\\Wallet\\Architecture\\ArchitectureServiceProvider',
      33 => 'App\\Wallet\\TransactionClearance\\ClearanceServiceProvider',
      34 => 'App\\Wallet\\BFIMerchant\\BFIMerchantServiceProvider',
      35 => 'App\\Wallet\\WalletIP\\WalletIPServiceProvider',
      36 => 'Barryvdh\\DomPDF\\ServiceProvider',
      37 => 'App\\Wallet\\CellPayUserTransaction\\CellPayUserTransactionServiceProvider',
      38 => 'App\\Wallet\\Microservice\\MicroserviceServiceProvider',
      39 => 'App\\Wallet\\NicAsia\\NICAsiaCyberSourceLoadTransactionServiceProvider',
      40 => 'App\\Wallet\\NPSAccountLinkLoad\\NPSAccountLinkLoadServiceProvider',
      41 => 'App\\Wallet\\LinkedAccounts\\LinkedAccountsServiceProvider',
      42 => 'App\\Wallet\\WalletAPI\\WalletAPIServiceProvider',
      43 => 'App\\Wallet\\MiracleInfoSMS\\MiracleInfoServiceProvider',
      44 => 'App\\Wallet\\Scheme\\SchemeServiceProvider',
      45 => 'App\\Wallet\\WalletRegistration\\WalletRegistrationServiceProvider',
      46 => 'App\\Wallet\\IssueTicket\\IssueTicketServiceProvider',
      47 => 'App\\Wallet\\BonusToMainBalanceTransfer\\BonusToMainBalanceTransferServiceProvider',
      48 => 'App\\Wallet\\SocialMediaChallenge\\SocialMediaChallengeServiceProvider',
      49 => 'App\\Wallet\\RefundPreTransaction\\RefundPreTransactionServiceProvider',
      50 => 'App\\Wallet\\NEA\\NEASettlementServiceProvider',
      51 => 'SimpleSoftwareIO\\QrCode\\QrCodeServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'PermissionServiceProvider' => 'Spatie\\Permission\\PermissionServiceProvider',
      'FCM' => 'LaravelFCM\\Facades\\FCM',
      'FCMGroup' => 'LaravelFCM\\Facades\\FCMGroup',
      'Debugbar' => 'Barryvdh\\Debugbar\\Facade',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'QrCode' => 'SimpleSoftwareIO\\QrCode\\Facades\\QrCode',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\Admin',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'backup' => 
  array (
    'backup' => 
    array (
      'name' => 'master',
      'source' => 
      array (
        'files' => 
        array (
          'include' => 
          array (
            0 => '/var/www/html',
          ),
          'exclude' => 
          array (
            0 => '/var/www/html/vendor',
            1 => '/var/www/html/node_modules',
          ),
          'followLinks' => true,
        ),
        'databases' => 
        array (
          0 => 'mysql',
          1 => 'dpaisa',
          2 => 'merchant',
        ),
      ),
      'database_dump_compressor' => NULL,
      'destination' => 
      array (
        'filename_prefix' => 'db_backup_',
        'disks' => 
        array (
          0 => 'public',
        ),
      ),
      'temporary_directory' => '/var/www/html/storage/app/backup-temp',
    ),
    'notifications' => 
    array (
      'notifications' => 
      array (
        'Spatie\\Backup\\Notifications\\Notifications\\BackupHasFailed' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\UnhealthyBackupWasFound' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupHasFailed' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\BackupWasSuccessful' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\HealthyBackupWasFound' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupWasSuccessful' => 
        array (
          0 => 'mail',
        ),
      ),
      'notifiable' => 'Spatie\\Backup\\Notifications\\Notifiable',
      'mail' => 
      array (
        'to' => 'your@example.com',
      ),
      'slack' => 
      array (
        'webhook_url' => '',
        'channel' => NULL,
        'username' => NULL,
        'icon' => NULL,
      ),
    ),
    'monitor_backups' => 
    array (
      0 => 
      array (
        'name' => 'master',
        'disks' => 
        array (
          0 => 'local',
        ),
        'health_checks' => 
        array (
          'Spatie\\Backup\\Tasks\\Monitor\\HealthChecks\\MaximumAgeInDays' => 1,
          'Spatie\\Backup\\Tasks\\Monitor\\HealthChecks\\MaximumStorageInMegabytes' => 5000,
        ),
      ),
    ),
    'cleanup' => 
    array (
      'strategy' => 'Spatie\\Backup\\Tasks\\Cleanup\\Strategies\\DefaultStrategy',
      'defaultStrategy' => 
      array (
        'keepAllBackupsForDays' => 7,
        'keepDailyBackupsForDays' => 16,
        'keepWeeklyBackupsForWeeks' => 8,
        'keepMonthlyBackupsForMonths' => 4,
        'keepYearlyBackupsForYears' => 2,
        'deleteOldestBackupsWhenUsingMoreMegabytesThan' => 5000,
      ),
    ),
    'monitorBackups' => 
    array (
      0 => 
      array (
        'name' => 'master',
        'disks' => 
        array (
          0 => 'local',
        ),
        'newestBackupsShouldNotBeOlderThanDays' => 1,
        'storageUsedMayNotBeHigherThanMegabytes' => 5000,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/var/www/html/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'master_cache',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'mysql_backend_wallet',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_backend_wallet',
        'port' => '3306',
        'database' => 'mysql_backend_wallet',
        'username' => 'root',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'dpaisa' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_core_wallet',
        'port' => '3306',
        'database' => 'homestead',
        'username' => 'homestead',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'merchant' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'forge',
        'username' => 'forge',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'paypoint' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_paypoint',
        'port' => '3306',
        'database' => 'mysql_paypoint',
        'username' => 'mysql_paypoint',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'nchl' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_nchl',
        'port' => '3306',
        'database' => 'mysql_nchl',
        'username' => 'mysql_nchl',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'nicasia' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_cybersource',
        'port' => '3306',
        'database' => 'mysql_cybersource',
        'username' => 'mysql_cybersource',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'ntc' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'forge',
        'username' => 'forge',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'npay' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_npay',
        'port' => '3306',
        'database' => 'mysql_npay',
        'username' => 'mysql_npay',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'nps' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_nps',
        'port' => '3306',
        'database' => 'mysql_nps',
        'username' => 'mysql_nps',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'bfi' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_bfigateway',
        'port' => '3306',
        'database' => 'mysql_bfigateway',
        'username' => 'mysql_bfigateway',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'khalti' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_khalti',
        'port' => '3306',
        'database' => 'mysql_khalti',
        'username' => 'root',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'cellpay' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_cellpay',
        'port' => '3306',
        'database' => 'mysql_cellpay',
        'username' => 'root',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'paymentnepal' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'forge',
        'username' => 'forge',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'nps-accountlink' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql_account_link',
        'port' => '3306',
        'database' => 'mysql_account_link',
        'username' => 'mysql_account_link',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'merchant-checkout' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'forge',
        'username' => 'forge',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'nea' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'forge',
        'username' => 'forge',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'fixture-tickets' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'forge',
        'username' => 'forge',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'event-tickets' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'forge',
        'username' => 'forge',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/bin/',
          0 => 'use_single_transaction',
          'timeout' => 300,
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => 'mysql_backend_wallet',
        'port' => '3306',
        'database' => 'mysql_backend_wallet',
        'username' => 'root',
        'password' => 'secret',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => 'mysql_backend_wallet',
        'port' => '3306',
        'database' => 'mysql_backend_wallet',
        'username' => 'root',
        'password' => 'secret',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
      'mongodb' => 
      array (
        'driver' => 'mongodb',
        'dsn' => '',
        'database' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'master_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'districts' => 
  array (
    'district_list' => 
    array (
      0 => 'Bhojpur',
      1 => 'Dhankuta',
      2 => 'Ilam',
      3 => 'Jhapa',
      4 => 'Khotang',
      5 => 'Morang',
      6 => 'Okhaldhunga',
      7 => 'Panchthar',
      8 => 'Sankhuwasabha',
      9 => 'Solukhumbu',
      10 => 'Sunsari',
      11 => 'Taplejung',
      12 => 'Terhathum',
      13 => 'Udayapur',
      14 => 'Bara',
      15 => 'Parsa',
      16 => 'Dhanusa',
      17 => 'Mahottari',
      18 => 'Rautahat',
      19 => 'Saptari',
      20 => 'Sarlahi',
      21 => 'Siraha',
      22 => 'Bhaktapur',
      23 => 'Chitwan',
      24 => 'Dhading',
      25 => 'Dolakha',
      26 => 'Kathmandu',
      27 => 'Kavrepalanchok',
      28 => 'Lalitpur',
      29 => 'Makwanpur',
      30 => 'Nuwakot',
      31 => 'Ramechhap',
      32 => 'Rasuwa',
      33 => 'Sindhuli',
      34 => 'Sindhupalchok',
      35 => 'Baglung',
      36 => 'Gorkha',
      37 => 'Kaski',
      38 => 'Lamjung',
      39 => 'Manang',
      40 => 'Mustang',
      41 => 'Myagdi',
      42 => 'Nawalparasi (East)',
      43 => 'Nawalparasi (West)',
      44 => 'Parbat',
      45 => 'Syangja',
      46 => 'Tanahun',
      47 => 'Arghakhanchi',
      48 => 'Banke',
      49 => 'Bardiya',
      50 => 'Dang Deukhuri',
      51 => 'Rukum (East)',
      52 => 'Gulmi',
      53 => 'Kapilvastu',
      54 => 'Palpa',
      55 => 'Pyuthan',
      56 => 'Rolpa',
      57 => 'Rupandehi',
      58 => 'Dailekh',
      59 => 'Dolpa',
      60 => 'Humla',
      61 => 'Jajarkot',
      62 => 'Jumla',
      63 => 'Kalikot',
      64 => 'Mugu',
      65 => 'Salyan',
      66 => 'Surkhet',
      67 => 'Rukum (West)',
      68 => 'Achham',
      69 => 'Achham',
      70 => 'Achham',
      71 => 'Baitadi',
      72 => 'Bajhang',
      73 => 'Bajura',
      74 => 'Dadeldhura',
      75 => 'Darchula',
      76 => 'Doti',
      77 => 'Kailali',
      78 => 'Kanchanpur',
    ),
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => '/var/www/html/storage/fonts/',
      'font_cache' => '/var/www/html/storage/fonts/',
      'temp_dir' => '/tmp',
      'chroot' => '/var/www/html',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'dpaisa-api-url' => 
  array (
    'kyc_documentation_url' => 'http://localhost:5052/storage/img/kyc/',
    'admin_documentation_url' => 'https://api.sajilopay.com.np/storage/img/agent/',
    'agent_url' => 'http://localhost:5052/storage/img/agent/',
    'merchant_kyc_documentation_url' => 'https://staging.merchant.silkinv.com/storage/img/kyc/',
    'public_document_url' => 'http://localhost:5052/storage/',
  ),
  'fcm' => 
  array (
    'driver' => 'http',
    'log_enabled' => false,
    'http' => 
    array (
      'server_key' => 'AAAAkRD5jcs:APA91bEd3o53seiqkw_XSHd54N3rMKpsn2HbE0qQSbr6JHTEt5jgnla29puB1jnq6DcGo29Sl-k1irOaZ-NhgWwPWjaf6SzQeKIKwvkc56yEWDhpVrQD-P-W0MjFvzWMWLtbW2pXkTgH',
      'sender_id' => '623055048139',
      'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
      'server_group_url' => 'https://android.googleapis.com/gcm/notification',
      'timeout' => 30.0,
    ),
    'topics' => 
    array (
      'kyc_unfilled' => 'user_kyc_unfilled',
      'kyc_unverified' => 'user_kyc_unverified',
      'kyc_verfied' => 'user_kyc_verified',
    ),
    'districts' => 
    array (
      0 => 'Bhojpur',
      1 => 'Dhankuta',
      2 => 'Ilam',
      3 => 'Jhapa',
      4 => 'Khotang',
      5 => 'Morang',
      6 => 'Okhaldhunga',
      7 => 'Panchthar',
      8 => 'Sankhuwasabha',
      9 => 'Solukhumbu',
      10 => 'Sunsari',
      11 => 'Taplejung',
      12 => 'Terhathum',
      13 => 'Udayapur',
      14 => 'Bara',
      15 => 'Parsa',
      16 => 'Dhanusa',
      17 => 'Mahottari',
      18 => 'Rautahat',
      19 => 'Saptari',
      20 => 'Sarlahi',
      21 => 'Siraha',
      22 => 'Bhaktapur',
      23 => 'Chitwan',
      24 => 'Dhading',
      25 => 'Dolakha',
      26 => 'Kathmandu',
      27 => 'Kavrepalanchok',
      28 => 'Lalitpur',
      29 => 'Makwanpur',
      30 => 'Nuwakot',
      31 => 'Ramechhap',
      32 => 'Rasuwa',
      33 => 'Sindhuli',
      34 => 'Sindhupalchok',
      35 => 'Baglung',
      36 => 'Gorkha',
      37 => 'Kaski',
      38 => 'Lamjung',
      39 => 'Manang',
      40 => 'Mustang',
      41 => 'Myagdi',
      42 => 'Nawalparasi (East)',
      43 => 'Nawalparasi (West)',
      44 => 'Parbat',
      45 => 'Syangja',
      46 => 'Tanahun',
      47 => 'Arghakhanchi',
      48 => 'Banke',
      49 => 'Bardiya',
      50 => 'Dang Deukhuri',
      51 => 'Rukum (East)',
      52 => 'Gulmi',
      53 => 'Kapilvastu',
      54 => 'Palpa',
      55 => 'Pyuthan',
      56 => 'Rolpa',
      57 => 'Rupandehi',
      58 => 'Dailekh',
      59 => 'Dolpa',
      60 => 'Humla',
      61 => 'Jajarkot',
      62 => 'Jumla',
      63 => 'Kalikot',
      64 => 'Mugu',
      65 => 'Salyan',
      66 => 'Surkhet',
      67 => 'Rukum (West)',
      68 => 'Achham',
      69 => 'Achham',
      70 => 'Achham',
      71 => 'Baitadi',
      72 => 'Bajhang',
      73 => 'Bajura',
      74 => 'Dadeldhura',
      75 => 'Darchula',
      76 => 'Doti',
      77 => 'Kailali',
      78 => 'Kanchanpur',
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public',
        'url' => 'http://localhost//storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/var/www/html/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/var/www/html/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => NULL,
    'username' => NULL,
    'password' => NULL,
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/var/www/html/resources/views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'microservices' => 
  array (
    'PAYPOINT' => 'nginx_paypoint/api/microservice',
    'NCHL' => 'nginx_nchl/api/microservice',
    'NIC_ASIA' => 'nginx_cybersource/api/microservice',
    'NTC' => '',
    'NPAY' => 'nginx_npay/api/microservice',
    'NPS' => 'nginx_nps/api/microservice',
    'NPS_ACCOUNT_LINK' => '',
    'KHALTI' => '',
    'CELLPAY' => '',
    'SAJILOPAY_REMITTANCE' => '',
    'PAYMENT_NEPAL' => '',
  ),
  'nea-branches' => 
  array (
    243 => 'AANBU',
    391 => 'ACHHAM',
    273 => 'AMUWA',
    268 => 'ANARMANI',
    248 => 'ARGHAKHACHI',
    384 => 'ARUGHAT',
    345 => 'ATTARIYA',
    237 => 'BADEGAUN SDC',
    299 => 'BAGLUNG',
    381 => 'BAITADI',
    215 => 'BALAJU',
    219 => 'BANESHWOR',
    373 => 'BANSGADHI',
    399 => 'BARAHATHAWA',
    267 => 'BARDAGHAT SDC',
    378 => 'BARDIBAS',
    277 => 'Barhabise',
    348 => 'BELAURI',
    317 => 'BELBARI',
    339 => 'BELTAR',
    265 => 'BHADRAPUR',
    272 => 'BHAIRAHAWA',
    370 => 'BHAJANI',
    245 => 'BHAKTAPUR DC',
    211 => 'BHARATPUR DC',
    270 => 'BHIMAN',
    316 => 'BHOJPUR',
    285 => 'BIRATNAGAR',
    286 => 'BIRGUNJ DC',
    301 => 'BODEBARSAIEN',
    333 => 'BUDHABARE SDC',
    223 => 'BUDHANILKANTHA',
    229 => 'BUTWAL',
    220 => 'Chabahil',
    315 => 'CHAINPUR',
    294 => 'CHANAULI',
    356 => 'CHANDRANIGAPUR',
    217 => 'CHAPAGAUN SDC',
    326 => 'CHAUTARA',
    385 => 'DADELDHURA',
    350 => 'DAILEKH',
    280 => 'DAMAK',
    241 => 'DAMAULI',
    383 => 'DARCHULA',
    224 => 'DHADING',
    344 => 'DHANGADI',
    284 => 'DHANKUTA',
    302 => 'DHANUSHADHAM',
    212 => 'DHARAN',
    269 => 'DHARKE',
    320 => 'DHULABARI SDC',
    375 => 'DHUNCHE DC',
    397 => 'DIKTEL',
    274 => 'DOLAKHA',
    388 => 'DOTI',
    271 => 'DUHABI',
    390 => 'DUMRE',
    308 => 'FICKEL',
    235 => 'GAIDAKOT SDC',
    297 => 'GAIGHAT',
    225 => 'GAJURI',
    323 => 'GAUR',
    287 => 'GAURADAH',
    359 => 'GAUSALA',
    250 => 'GHORAHI',
    238 => 'GORKHA',
    242 => 'GULARIYA',
    290 => 'GULMI',
    330 => 'HANUMAN',
    231 => 'HETAUDA',
    292 => 'IILAM',
    281 => 'INARUWA',
    264 => 'ITAHARI',
    354 => 'JAHARE',
    392 => 'JAJARKOT',
    331 => 'JALESHOR',
    261 => 'JANAKPUR DC',
    275 => 'JIRI',
    386 => 'JOGBUDA',
    221 => 'JORPATI',
    318 => 'KALAIYA',
    380 => 'KALIKOT',
    351 => 'KANCHANPUR',
    338 => 'KATARI',
    247 => 'KAVRE',
    234 => 'KAWASOTI',
    306 => 'Khadbari',
    325 => 'khajura',
    282 => 'KHARIDHUNGA',
    246 => 'KIRTIPUR',
    309 => 'KNAGAR',
    324 => 'KOHALPUR',
    205 => 'KULESHOR',
    216 => 'LAGANKHEL DC',
    293 => 'LAHAN',
    379 => 'LALBANDI',
    251 => 'LAMAHI',
    332 => 'Lamjung',
    343 => 'LAMKI',
    228 => 'Lekhnath',
    218 => 'LUBHU SDC',
    307 => 'LUMBINI',
    222 => 'MAHARAJGUNJ DC',
    347 => 'MAHENDRANAGAR',
    376 => 'MAINAPOKHARI',
    239 => 'Majuwa',
    305 => 'MALANGWA',
    396 => 'MANGALSEN',
    296 => 'MANTHALI',
    303 => 'MAULAPUR',
    337 => 'MELAMCHI',
    334 => 'Mirchiya',
    310 => 'MIRMI',
    362 => 'MUDHE',
    319 => 'MYAGDI',
    214 => 'NAXAL',
    313 => 'NAYAMILL',
    256 => 'NEPALGUNJ',
    279 => 'nijgadh',
    232 => 'Nuwakot',
    355 => 'OKHALDHUNGA DC',
    263 => 'PALPA',
    262 => 'PALUNG',
    335 => 'PANAUTI',
    249 => 'PANCHKHAL',
    395 => 'PANCHTHAR',
    321 => 'PARASI',
    240 => 'PARBAT',
    314 => 'PASHUPATINAGAR',
    382 => 'PATAN',
    226 => 'POKHARA DC',
    227 => 'POKHARA GRAMIN SDC',
    360 => 'POKHARIYA',
    207 => 'PULCHOWK',
    357 => 'PYUTHAN',
    371 => 'RAJAPUR',
    329 => 'RAJBIRAJ',
    336 => 'RAMECHHAP',
    291 => 'RANGELI',
    288 => 'RANI SUB DC',
    201 => 'RATNAPARK DC',
    311 => 'RIDI',
    387 => 'ROLPA',
    346 => 'RUKUM',
    374 => 'SAKHUWA',
    349 => 'SALYAN',
    352 => 'SANISCHARE SDC',
    322 => 'SANKHU',
    398 => 'SILGADHI',
    230 => 'simara',
    304 => 'SIMRAUNGADH',
    276 => 'SINDHU',
    233 => 'SINDHULI',
    312 => 'SIRAHA',
    298 => 'SOLU',
    327 => 'SURAJPURA',
    353 => 'SURKHET',
    358 => 'SURUNGA',
    278 => 'SYANGJA',
    236 => 'TANDI',
    377 => 'TATOPANI',
    283 => 'TAULIHAWA',
    341 => 'TEHRATHUM',
    244 => 'THIMI DC',
    342 => 'TIKAPUR',
    328 => 'TRIVENI',
    252 => 'TULSIPUR',
    363 => 'TUMLINGTAR',
    295 => 'URLABARI',
    372 => 'VURIGAUN',
    389 => 'YADUKUWA',
  ),
  'onesignal' => 
  array (
    'url' => 'https://onesignal.com/api/v1/notifications',
    'app_id' => '8047c82e-b39a-45a7-98a7-12200d78888d',
    'auth_code' => 'MGQ3ZWFhNTEtYTQ4Ny00NGFkLWEyYTAtNWNmMWI2MmIxOGFh',
    'tags' => 
    array (
      'kyc_filled_users' => 
      array (
        'title' => 'kyc_filled_users',
        'filter' => 
        array (
          'field' => 'tag',
          'key' => 'kyc_status',
          'relation' => '=',
          'value' => '1',
        ),
      ),
      'kyc_rejected_users' => 
      array (
        'title' => 'kyc_rejected_users',
        'filter' => 
        array (
          'field' => 'tag',
          'key' => 'kyc_status',
          'relation' => '=',
          'value' => '-1',
        ),
      ),
      'kyc_unfilled_users' => 
      array (
        'title' => 'kyc_unfilled_users',
        'filter' => 
        array (
          'field' => 'tag',
          'key' => 'kyc_status',
          'relation' => '=',
          'value' => '0',
        ),
      ),
      'kyc_validated_users' => 
      array (
        'title' => 'kyc_validated_users',
        'filter' => 
        array (
          'field' => 'tag',
          'key' => 'kyc_status',
          'relation' => '=',
          'value' => '2',
        ),
      ),
    ),
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'Spatie\\Permission\\Models\\Permission',
      'role' => 'Spatie\\Permission\\Models\\Role',
    ),
    'table_names' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'model_has_permissions' => 'model_has_permissions',
      'model_has_roles' => 'model_has_roles',
      'role_has_permissions' => 'role_has_permissions',
    ),
    'column_names' => 
    array (
      'model_morph_key' => 'model_id',
    ),
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,
    'cache' => 
    array (
      'expiration_time' => 
      DateInterval::__set_state(array(
         'y' => 0,
         'm' => 0,
         'd' => 0,
         'h' => 24,
         'i' => 0,
         's' => 0,
         'f' => 0.0,
         'weekday' => 0,
         'weekday_behavior' => 0,
         'first_last_day_of' => 0,
         'invert' => 0,
         'days' => false,
         'special_type' => 0,
         'special_amount' => 0,
         'have_weekday_relative' => 0,
         'have_special_relative' => 0,
      )),
      'key' => 'spatie.permission.cache',
      'model_key' => 'name',
      'store' => 'default',
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => true,
    'encrypt' => false,
    'files' => '/var/www/html/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'master_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'sparrow-sms' => 
  array (
    'base_url' => 'http://api.sparrowsms.com',
    'url' => '/v2/sms/',
    'from' => 'InfoSMS',
    'token' => 'EgTsRP0Aj4ZaGwQXCWit',
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/var/www/html/resources/views',
    ),
    'compiled' => '/var/www/html/storage/framework/views',
  ),
  'wallet-registration' => 
  array (
    'base_url' => 'nginx_core_wallet/api',
    'generate_otp_url' => '/otp/mobile/generate',
    'merchant_registration' => '/merchant/register',
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => '/var/www/html/storage/debugbar',
      'connection' => NULL,
      'provider' => '',
      'hostname' => '127.0.0.1',
      'port' => 2304,
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
      'models' => true,
      'livewire' => true,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'backtrace_exclude_paths' => 
        array (
        ),
        'timeline' => false,
        'duration_background' => true,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => false,
        'show_copy' => false,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'timeline' => false,
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
    'theme' => 'auto',
    'debug_backtrace_limit' => 50,
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 94,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
