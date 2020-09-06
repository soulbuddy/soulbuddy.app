<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserUnlockSecret
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $secret_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserUnlockSecret newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserUnlockSecret newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserUnlockSecret query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserUnlockSecret whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserUnlockSecret whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserUnlockSecret whereSecretId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserUnlockSecret whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserUnlockSecret whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserUnlockSecret findUniquePair($secretId, $userId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserUnlockSecret userId($userId)
 */
class UserUnlockSecret extends Model
{
    protected $fillable = ['user_id', 'secret_id'];
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $secretId
     * @param mixed $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindUniquePair($query, $secretId, $userId)
    {
        return $query->where(['user_id', $userId], ['secret_id', $secretId]);
    }

    public function belongsToUser()
    {
        $this->belongsTo('App\User');
    }

    public function beloogsToSecret()
    {
        $this->belongsTo('App\Secret');
    }
}
