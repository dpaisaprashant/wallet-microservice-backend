<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetDailyLimit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:daily-limit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Daily Limit of the user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        User::all()->map(function ($query) {
            if (!$query->currentLimit()) $query->createLimit();
            if($query->hasValidKyc()){
                return $query->currentLimit()->resetDailyVerifiedAmounts();
            }
            return $query->currentLimit()->resetDailyAmounts();

        });
        $this->info("Daily Limits reset sucessfully");
    }
}
