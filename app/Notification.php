<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Notification
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification query()
 * @mixin \Eloquent
 */
class Notification extends Model
{
    protected $fillable = ['title', 'description', 'notification_type_id', 'is_read', 'is_deleted'];
}
