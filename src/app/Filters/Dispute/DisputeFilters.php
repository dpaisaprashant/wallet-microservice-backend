<?php
namespace App\Filters\Dispute;

use App\Filters\FiltersAbstract;


class DisputeFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'transaction_id' => IdFilter::class,
        'user' => UserFilter::class,
        'vendor_type' => VendorTypeFilter::class,
        'source' => ErrorSourceFilter::class,
        'handler' => HandlerFilter::class,
        'user_dispute_status' => UserDisputeStatusFilter::class,
        'clearance_dispute_status' =>  ClearanceDisputeStatusFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'total_vendor_amount' => VendorAmountFilter::class,
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
