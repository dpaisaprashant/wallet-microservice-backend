<?php

namespace App\Console;

use App\Console\Commands\MisMatchReconciliation;
use App\Wallet\Report\Corn\CheckUserBalanceMismatch;
use App\Wallet\Report\Corn\MisMatchUserReconciliation;
use App\Wallet\Session\AdminSession;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Wallet\WalletAPI\Cron\NchlApiCompareTransactions;
use App\Wallet\WalletAPI\Cron\NchlAggregatedApiCompareTransactions;
use App\Wallet\WalletAPI\Cron\PaypointApiCompareTransactions;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(new MisMatchUserReconciliation())->everyFifteenMinutes();
        $schedule->call(new AdminSession)->everyMinute();
        $schedule->call(new CheckUserBalanceMismatch)->hourly();
        //$schedule->call(new NchlApiCompareTransactions)->everyMinute();
        //$schedule->call(new NchlAggregatedApiCompareTransactions)->everyMinute();
        //$schedule->call(new PaypointApiCompareTransactions)->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
