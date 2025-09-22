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

    // Show users management
    public function users()
    {
        $users = \App\Models\User::latest()->get();
        return view('admin.users', compact('users'));
    }

    // Update user role
    public function updateUserRole(\App\Models\User $user, Request $request)
    {
        $request->validate([
            'role' => ['required', 'string', 'in:user,member,admin'],
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->back()->with('success', "User {$user->name} role updated to {$request->role}.");
    }
}
