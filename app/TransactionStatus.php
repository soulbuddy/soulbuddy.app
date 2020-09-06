<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TransactionStatus
 *
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionStatus query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionStatus whereUpdatedAt($value)
 * @property-read \App\UserTransaction $userTransaction
 */
class TransactionStatus extends Model
{
    protected $fillable = ['status'];

    public function userTransaction() {
        return $this->belongsTo('App\UserTransaction', 'status', 'id');
    }
}
