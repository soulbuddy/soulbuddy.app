<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TransactionType
 *
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionType query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TransactionType whereUpdatedAt($value)
 * @property-read \App\UserTransaction $userTransaction
 */
class TransactionType extends Model
{
    protected $fillable = ['type'];

    public function userTransaction() {
        return $this->belongsTo('App\UserTransaction', 'transaction_type', 'id');
    }
}
