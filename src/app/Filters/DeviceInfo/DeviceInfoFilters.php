<?php

namespace App\Filters\DeviceInfo;

use App\Filters\FiltersAbstract;

class DeviceInfoFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'mobile_no' => MobileNoFilter::class,
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping()
    {
        $map = [
            'sort' => [
                'date' => 'created_at',
            ]
        ];

        return $map;
    }
}
