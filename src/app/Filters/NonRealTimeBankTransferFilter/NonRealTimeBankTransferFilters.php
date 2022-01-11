<?php

namespace App\Filters\NonRealTimeBankTransferFilter;

use App\Filters\FiltersAbstract;

class NonRealTimeBankTransferFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'transaction_id' => TransactionIdFilter::class,
        'vendor' => VendorFilter::class,
        'debit_status' => DebitStatusFilter::class,
        'credit_status' => CreditStatusFilter::class,
        'admin' => AdminFilter::class,
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping()
    {
        $map = [

        ];

        return $map;
    }
}
