<?php

namespace App\Models;

use App\Filters\FCMNotification\NotificationFilters;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FCMNotification extends Model
{
    use BelongsToUser;

    protected $table = 'user_fcm_notifications';
    protected $connection = 'dpaisa';

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'data',
        'notification_type',
        'backend_user_id',
        'image',
    ];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new NotificationFilters($request))->add($filters)->filter($builder);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'backend_user_id');
    }


}
