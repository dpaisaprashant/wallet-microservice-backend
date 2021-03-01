<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetMonthlyLimit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:monthly-limits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset monthly limits of the user';

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
                return $query->currentLimit()->resetMonthlyVerifiedAmounts();
            }
            return $query->currentLimit()->resetMonthlyAmounts();

        });
        $this->info("Monthly Limits reset sucessfully");
    }
}
