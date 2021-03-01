<?php

namespace App\Traits;

use App\Models\User;

/**
 * Relation for the user
 */
trait BelongsToUseThroughMicroservice
{
    use BelongsToRequestInfo, BelongsToPreTransaction;

    public function getUserIdAttribute()
    {
        $this->appends = array_merge($this->appends, ['user_id']);

        $preTransaction = $this->preTransaction()->first() ?? null;
        $requestInfo = $this->requestInfo()->first() ?? null;

        //dd($preTransaction, $requestInfo);

        if ($preTransaction) {
            return $preTransaction->user_id;
        }

        if ($requestInfo) {
            return $requestInfo->user_id;
        }
        return null;


    }
}
