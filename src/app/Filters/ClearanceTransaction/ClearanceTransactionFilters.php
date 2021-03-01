<?php
namespace App\Filters\ClearanceTransaction;

use App\Filters\FiltersAbstract;

class ClearanceTransactionFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'clearance_id' =>ClearanceFilter::class,
        'transaction_id' => IdFilter::class,
        'user' => UserFilter::class,
        'vendor' => VendorFilter::class,
        'service' => ServiceFilter::class,
        'amount' => AmountFilter::class,
        'status' => StatusFilter::class
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
