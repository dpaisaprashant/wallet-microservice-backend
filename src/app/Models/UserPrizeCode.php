<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class UserPrizeCode extends Model
{
    use BelongsToUser;

    protected $connection = 'dpaisa';

    protected $guarded = [];

    public function createPrizeCodeForUser(User $user)
    {
        $latestCode = $this->orderBy('id', 'DESC')->first();
        if (empty($latestCode)) return;

        UserPrizeCode::create([
            'user_id' => $user->id,
            'code' => $latestCode->code + 1
        ]);
    }
}
