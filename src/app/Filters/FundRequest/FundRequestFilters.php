<?php

namespace App\Filters\FundRequest;

use App\Filters\FiltersAbstract;

class FundRequestFilters extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from_user' => FromUserFilter::class,
        'to_user' => ToUserFilter::class,
        'amount' => AmountFilter::class,
        'request_from' => RequestFromDateFilter::class,
        'request_to' => RequestToDateFilter::class,
        'response_from' => ResponseFromDateFilter::class,
        'response_to' => ResponseToDateFilter::class,
        'request_status' => RequestStatusFilter::class,
        'response_status' => ResponseStatusFilter::class,
        'sort' => SortFilter::class,
        'from' => RequestFromDateFilter::class,
        'to' => RequestFromDateFilter::class
    ];

    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
        $map = [
            'request_status' => [
                'successful' => 1,
                'failed' => 0
            ],
            'response_status' => [
                'accepted' => 1,
                'rejected' => 0,
                'pending' => 2
            ],
            'sort' => [
                'request_date' => 'created_at',
                'response_date' => 'updated_at',
                'amount' => 'amount'
            ]
        ];

        return  $map;
    }
}
