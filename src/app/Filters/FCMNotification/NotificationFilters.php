<?php

namespace App\Filters\FCMNotification;

use App\Filters\FiltersAbstract;

class NotificationFilters extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'send_to' => SendToUserFilter::class,
        'send_from' => SendFromUserFilter::class,
        'title' => NotificationTitleFilter::class,
        'type' => NotificationTypeFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class
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
