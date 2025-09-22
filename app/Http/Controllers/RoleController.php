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
            $errorMessage = "Access Denied: You need '{$role}' role to access this section. ";
            $errorMessage .= "Your current role is '{$user->role}'. ";
            $errorMessage .= "Please contact an administrator to upgrade your role.";

            abort(403, $errorMessage);
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
