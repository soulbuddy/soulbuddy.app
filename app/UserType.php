<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserType
 *
 * @property int $id
 * @property int $type
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserType extends Model
{
    protected $fillable = [
        'type', 'description',
    ];
}
