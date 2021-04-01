<?php


namespace App\Traits;


use App\Models\Microservice\PreTransaction;
use App\Models\Microservice\RequestInfo;

trait BelongsToRequestInfo
{
    public function requestInfo()
    {
        return $this->belongsTo(RequestInfo::class, 'request_id', 'request_id');
    }
}
