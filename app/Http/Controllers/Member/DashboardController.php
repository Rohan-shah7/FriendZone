<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    // Show member feed
    public function feed()
    {
        $posts = Post::with(['user', 'likes', 'comments.replies', 'favourites'])->latest()->get();
        return view('members.feed', compact('posts'));
    }

    // Show create post form
    public function createPost()
    {
        return view('members.create_post');
    }

    // Store new post
    public function storePost(Request $request)
    {
        $request->validate([
            'postdetails' => 'required|string',
            'post' => 'nullable|string',
        ]);

        $post = Post::create([
            'created_by' => Auth::id(),
            'postdetails' => $request->postdetails,
            'post' => $request->post,
            'status' => 'pending', // members' posts need approval
        ]);

        return redirect()->route('members.feed')->with('success', 'Post created! You are now a full member.');
    }
}
