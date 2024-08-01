<?php
namespace App\Filters\UserToBFIFundTransferFilter;

use App\Filters\FiltersAbstract;

class UserToBFIFundTransferFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'user' =>  UserFilter::class,
        'bfi_id' => BFIIdFilter::class,
        'transaction_id' => TransactionIdFilter::class,
        'process_id' => ProcessIdFilter::class,
        'status' => StatusFilter::class,
        'from_pre_transaction_id' => FromPreTransactionIdFilter::class,
        'to_pre_transaction_id' => ToPreTransactionIdFilter::class,
        'wallet_id' => WalletIdFilter::class
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
//        $map = [
//            'sort' => [
//                'date' => 'created_at',
//                'amount' => 'amount'
//            ]
//        ];
//
//        return  $map;
    }
}
