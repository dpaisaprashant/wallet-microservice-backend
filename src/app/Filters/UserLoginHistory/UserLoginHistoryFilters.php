<?php
namespace App\Filters\UserLoginHistory;

use App\Filters\FiltersAbstract;

class UserLoginHistoryFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'user' => UserFilter::class,
        'public_ip' => PublicIpFilter::class,
        'server_ip' => ServerIpFilter::class,
        'agent' => AgentFilter::class
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
