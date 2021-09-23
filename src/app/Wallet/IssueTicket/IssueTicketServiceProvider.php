<?php


namespace App\Wallet\IssueTicket;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class IssueTicketServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/issue-ticket.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'IssueTicket');
    }

}
