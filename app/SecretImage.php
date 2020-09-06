<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SecretImage
 *
 * @property int $id
 * @property int $secret_id
 * @property string $secret_image_path
 * @property string|null $secret_image_caption
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretImage whereSecretId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretImage whereSecretImageCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretImage whereSecretImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SecretImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SecretImage extends Model
{
    //
}
