<?php
namespace App\Filters\PreTransactionFilters;

use App\Filters\FiltersAbstract;

class PreTransactionFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'user_id' => UsersFilter::class,
        'pre_transaction_id' => PreTransactionIdFilter::class,
        'vendor'=>PreTransactionVendorFilter::class,
        'status'=>PreTransactionStatusFilter::class,
        'service_type' => PreTransactionServiceTypeFilter::class,
        'microservice_type' => PreTransactionMicroServiceTypeFilter::class,
        'transaction_type' => PreTransactionTypeFilter::class,
        'from_preTransaction_amount' => FromPreTransactionAmountFilter::class,
        'to_preTransaction_amount' => ToPreTransactionAmountFilter::class,
        'from' => PreTransactionDateFrom::class,
        'to' => PreTransactionDateTo::class,
        'sort'=>SortPreTransaction::class,
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
        $map = [

        ];

        return  $map;
    }
}
