<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SecretRating
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretRating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretRating query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $secret_id
 * @property int $user_id
 * @property string|null $comment
 * @property float $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretRating whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretRating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretRating whereSecretId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretRating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretRating whereUserId($value)
 */
class SecretRating extends Model
{
    public function secret() {
        $this->belongsTo('App\Secret');
    }

    public function author() {
        $this->belongsTo('App\User');
    }
}
