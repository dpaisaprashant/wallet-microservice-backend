<?php


namespace App\Wallet\Report\Traits;


use App\Wallet\Report\Repositories\AbstractReportRepository;

trait ReconciliationReportGenerator
{

    public function generateReport(AbstractReportRepository $repository)
    {
        return  [
            'Paypoint' => [
                "amount" => $repository->totalPaypointTransactionAmount() / 100,
                "count" => $repository->totalPaypointTransactionCount(),
                "transaction_type" => "debit"
            ],

            'NPay' => [
                "amount" => $repository->totalNPayTransactionAmount() / 100,
                "count" => $repository->totalNPayTransactionCount(),
                "transaction_type" => "credit"
            ],

            'NPS' => [
                "amount" => $repository->totalNpsTransactionAmount() / 100,
                "count" => $repository->totalNpsTransactionCount(),
                "transaction_type" => "credit"
            ],

            'Cashback' => [
                "amount" => $repository->totalCashbackAmount() / 100,
                "count" => $repository->totalCashbackCount(),
                "transaction_type" => "credit"
            ],

            'Commission' => [
                "amount" => $repository->totalCommissionAmount() / 100,
                "count" => $repository->totalCommissionCount(),
                "transaction_type" => "debit"
            ],

            'TestFund' => [
                "amount" => $repository->totalTestFundsAmount() / 100,
                "count" => $repository->totalTestFundsCount(),
                "transaction_type" => "credit"
            ],

            'Referral' => [
                "amount" => $repository->totalReferralAmount() / 100,
                "count" => $repository->totalReferralCount(),
                "transaction_type" => "credit"
            ],

            'ConnectIPS' => [
                "amount" => $repository->totalNchlLoadAmount() / 100,
                "count" => $repository->totalNchlLoadCount(),
                "transaction_type" => "credit"
            ],

            'NIC Asia CyberSource' => [
                "amount" => $repository->totalNicAsiaCyberSourceLoadAmount() / 100,
                "count" => $repository->totalNicAsiaCyberSourceLoadCount(),
                "transaction_type" => "credit"
            ],

            'NCHL Bank Transfer' => [
                "amount" => $repository->totalNchlBankTransferAmount() / 100,
                "count" => $repository->totalNchlBankTransferCount(),
                "transaction_type" => "debit"
            ],

            'NCHL Aggregated Payment' => [
                "amount" => $repository->totalNchlAggregatedPaymentAmount() / 100,
                "count" => $repository->totalNchlAggregatedPaymentCount(),
                "transaction_type" => "debit"
            ],

            'User to Merchant Transaction' => [
                "amount" => $repository->totalUserToMerchantAmount() / 100,
                "count" => $repository->totalUserToMerchantCount(),
                "transaction_type" => "debit"
            ],

            'Merchant Ticket Payment' => [
                'amount' => $repository->totalUserToMerchantEventTicketPaymentAmount() / 100,
                'count' => $repository->totalUserToMerchantEventTicketPaymentCount(),
                'transaction_type' => 'debit'
            ],

            'Rounding off' => [
                'amount' => $repository->totalRoundOffAmount(),
                'count' => $repository->totalRoundOffCount(),
                'transaction_type' => 'rounding off'
            ],

            'WalletBalance' => [
                "amount" => $repository->totalWalletBalanceAmount() / 100,
                "count" => $repository->totalWalletBalanceCount(),
                "transaction_type" => "balance"
            ],

            'BonusBalance' => [
                "amount" => $repository->totalBonusBalanceAmount() / 100,
                "count" => $repository->totalWalletBalanceCount(),
                "transaction_type" => "balance"
            ],

            "Total Balance" => [
                "amount" => ($repository->totalWalletBalanceAmount() + $repository->totalBonusBalanceAmount()) / 100 ,
                "count" => $repository->totalWalletBalanceCount(),
                "transaction_type" => "balance"
            ],
        ];
    }
}
