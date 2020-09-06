<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticleImage
 *
 * @package App
 * @mixin \Eloquent
 * @property int $id
 * @property int $article_id
 * @property string $article_image_path
 * @property string|null $article_image_caption
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Article $article
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleImage whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleImage whereArticleImageCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleImage whereArticleImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleImage whereUpdatedAt($value)
 */
class ArticleImage extends Model
{
    protected $fillable = ['article_id', 'article_image_path', 'article_image_caption'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
