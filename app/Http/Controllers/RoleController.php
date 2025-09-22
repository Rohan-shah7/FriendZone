<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function selectRole($role)
    {
        $user = Auth::user();

        // Validate that the user has the requested role
        if ($user->role !== $role) {
            abort(403, 'Access denied. You do not have the required role.');
        }

        // Redirect based on role
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'member':
                return redirect()->route('member.create_post');

            case 'user':
                return redirect()->route('user.feed');

            default:
                return redirect()->route('dashboard')->with('error', 'Invalid role selected.');
        }
    }
}
