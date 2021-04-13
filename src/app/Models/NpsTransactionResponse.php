<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NpsTransactionResponse extends Model
{
    protected $connection = 'nps';

    protected $fillable = [
        "response"
    ];

    protected $casts = [
        "response" => "array"
    ];

    public function transaction()
    {
        return $this->belongsTo(NpsLoadTransaction::class, "load_id", "id");
    }
}
