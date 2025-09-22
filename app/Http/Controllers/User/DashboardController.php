<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show feed for regular users
    public function feed()
    {
        $posts = Post::with(['user', 'likes', 'comments.replies', 'favourites'])->latest()->get();
        return view('users.feed', compact('posts'));
    }

    // Like a post
    public function likePost($postId)
    {
        $like = \App\Models\PostHasLike::firstOrCreate([
            'user_id' => Auth::id(),
            'post_id' => $postId,
        ]);
        return response()->json($like);
    }

    // Like a comment
    public function likeComment($commentId)
    {
        $like = \App\Models\CommentHasLike::firstOrCreate([
            'user_id' => Auth::id(),
            'post_has_comment_id' => $commentId,
        ]);
        return response()->json($like);
    }

    // Add favourite
    public function addFavourite($postId)
    {
        $fav = \App\Models\UserHaveFavourite::firstOrCreate([
            'user_id' => Auth::id(),
            'post_id' => $postId,
        ]);
        return response()->json($fav);
    }
}
