<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rating
 *
 * @package App
 * @property int $id
 * @property int $article_id
 * @property int $secret_id
 * @property int $user_id
 * @property string|null $comment
 * @property float $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Article $articleReviewer
 * @property-read \App\Secret $secretReviewer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereSecretId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rating whereUserId($value)
 * @mixin \Eloquent
 */
class Rating extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'article_id', 'secret_id', 'user_id', 'comment', 'rating'];

    public function articleReviewer()
    {
        return $this->belongsTo('App\Article', 'id', 'article_id');
    }

    public function secretReviewer()
    {
        return $this->belongsTo('App\Secret', 'id', 'secret_id');
    }
}
