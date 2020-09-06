<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserTransaction
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $transaction_type
 * @property float $amount
 * @property int $status
 * @property int $to_user_id
 * @property string $reference_id
 * @property string $payment_id
 * @property string $intent
 * @property string $payer_email
 * @property string $payee_email
 * @property string $payer_id
 * @property string $merchant_id
 * @property string $country_code
 * @property string $given_name
 * @property string $surname
 * @property string $ccy
 * @property string $payment_method
 * @property string|null $order_create_time
 * @property string|null $payment_create_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereToUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereCcy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereGivenName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereIntent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereOrderCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction wherePayeeEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction wherePayerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction wherePayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction wherePaymentCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTransaction whereSurname($value)
 */
class UserTransaction extends Model
{
    protected $fillable = ['to_user_id', 'payment_id', 'payer_id', 'merchant_id', 'payer_email', 'payee_email', 'transaction_type',
        'country_code', 'amount', 'ccy', 'given_name', 'surname', 'intent', 'payment_method', 'status', 'reference_id', 'order_create_time', 'payment_create_time'];

    public function owner() {
        $this->belongsTo('App\User');
    }

    public function transactionType() {
        $this->hasOne('App\TransactionType');
    }

    public function transactionStatus() {
        $this->hasOne('App\TransactionStatus');
    }
}
