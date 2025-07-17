<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.dashboard', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:seller,customer',
        ]);

        // Prevent changing the role of the main admin
        if ($user->name === 'musiala' && $user->email === 'admin@admin.com') {
            $msg = 'You cannot change the role of the main admin.';
            if ($request->expectsJson()) {
                return response()->json(['error' => $msg], 403);
            }
            return redirect()->back()->with('error', $msg);
        }

        // Remove all roles and assign the new one
        $user->syncRoles([$request->role]);

        if ($request->expectsJson()) {
            return response()->json(['status' => 'Role updated successfully.']);
        }

        return redirect()->back()->with('status', 'Role updated successfully.');
    }
}
