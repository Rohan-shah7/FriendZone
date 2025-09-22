<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show all posts for admin
    public function dashboard()
    {
        $posts = Post::with('user')->latest()->get();
        return view('admin.dashboard', compact('posts'));
    }

    // Approve post
    public function approvePost(Post $post)
    {
        $post->update(['status' => 'verified']);
        return redirect()->back()->with('success', 'Post approved.');
    }

    // Reject post
    public function rejectPost(Post $post)
    {
        $post->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Post rejected.');
    }

    // Delete post
    public function deletePost(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted.');
    }
}
