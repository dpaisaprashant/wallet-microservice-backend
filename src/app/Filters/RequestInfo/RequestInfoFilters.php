<?php
namespace App\Filters\RequestInfo;

use App\Filters\FiltersAbstract;

class RequestInfoFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'request_id' => RequestIdFilter::class,
        'uid' => UserIdFilter::class,
        'status' =>StatusFilter::class,
        'vendor' => VendorFilter::class,
        'service_type' => ServiceTypeFilter::class,
        'microservice_type' => MicroServiceTypeFilter::class,
        'latest_date' => LatestDateFilter::class,
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
        $map = [
            'sort' => [
                'date' => 'created_at',
            ]
        ];

        return  $map;
    }
}
