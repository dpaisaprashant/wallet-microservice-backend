<?php


namespace App\Wallet\DumpDB;


use Backup\BackupServiceProvider;

class DumpDB extends BackupServiceProvider
{
    /**
     * The database connection data.
     *
     * @var array
     */
    protected $connection;

    /**
     * The database connection data.
     *
     * @var array
     */
    protected $connection2;


    public function __construct()
    {
        parent::__construct();

        $this->mysqldumpPath = config('backup.mysql.mysqldump_path', 'mysqldump');

        $this->connection = [
            'host'     => config('database.connections.mysql.host'),
            'database' => config('database.connections.mysql.database'),
            'port'     => config('database.connections.mysql.port'),
            'username' => config('database.connections.mysql.username'),
            'password' => config('database.connections.mysql.password'),
        ];

        $this->connection2 = [
            'host'     => config('database.connections.dpaisa.host'),
            'database' => config('database.connections.dpaisa.database'),
            'port'     => config('database.connections.dpaisa.port'),
            'username' => config('database.connections.dpaisa.username'),
            'password' => config('database.connections.dpaisa.password'),
        ];
        
    }
}
