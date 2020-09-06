<?php

namespace App\Http\Controllers;

use App\Article;
use App\Rating;
use App\Secret;
use App\SecretRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class RatingController extends Controller
{

    public function getAllRelatedRatings(Request $request)
    {
        $isArticle = $request->isArticle;

        if (!$isArticle) {
            $ratings = SecretRating::orderBy('created_at', 'desc')->get();
        } else {
            $ratings = Rating::orderBy('created_at', 'desc')->get();
        }

        return response()->json(['error' => false, 'data' => $ratings]);
    }

    public function editaRating(Request $request)
    {

    }

    public function rateAnArticle(Request $request)
    {
        $userId = auth()->user()->id;
        $articleId = $request->article_id;
        $comment = $request->comment;
        $rating = $request->rating;
        $article = Article::find($articleId);

        Rating::create([
            'user_id' => $userId,
            'article_id' => $articleId,
            'comment' => $comment,
            'rating' => $rating,
        ]);

        $numberOfRating = Rating::where('article_id', $articleId)->count();
        $newRating = ($article->overall_rating + $rating) / $numberOfRating;
        $article->overall_rating = $newRating;
        if (!$article->is_rated) $article->is_rated = true;
        $article->save();

        return response()->json(['error' => false, 'new_rating' => $newRating]);
    }

    public function rateASecret(Request $request)
    {

        $userId = $request->userId;
        $secretId = $request->secretId;
        $comment = $request->comment;
        $rating = $request->rating;
        $secret = Secret::find($secretId);

        SecretRating::create([
            'user_id' => $userId,
            'secret_id' => $secretId,
            'comment' => $comment,
            'rating' => $rating,
        ]);
        $numberOfRating = Rating::count([
            'secret_id' => $secretId,
        ]);
        $newRating = ($secret->overall_rating + $rating) / $numberOfRating;
        $secret->overall_rating = $newRating;
        $secret->save();
    }
}
