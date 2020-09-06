<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pricing
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pricing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pricing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pricing query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $token
 * @property float $price
 * @property string $ccy
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pricing whereCcy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pricing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pricing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pricing wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pricing whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pricing whereUpdatedAt($value)
 */
class Pricing extends Model
{
    protected $fillable = ['token', 'price', 'ccy'];
}
