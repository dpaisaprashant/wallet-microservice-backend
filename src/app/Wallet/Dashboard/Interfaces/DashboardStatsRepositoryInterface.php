<?php


namespace App\Wallet\Dashboard\Interfaces;


interface DashboardStatsRepositoryInterface
{
    public function successfulTransactionBuilder();

    public function pendingDisputeBuilder();

    public function resolvedDisputeBuilder();
}
