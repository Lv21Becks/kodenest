<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminSystemController extends Controller
{
    public function index()
    {
        $admins = User::whereIn('role', [
            User::ROLE_SUPER_ADMIN,
            User::ROLE_ADMIN,
            User::ROLE_MODERATOR
        ])->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.system-users.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.system-users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_ADMIN, User::ROLE_MODERATOR])],
        ]);

        // Prevent standard admins from creating super admins
        if ($validated['role'] === User::ROLE_SUPER_ADMIN && !auth()->user()->hasRole(User::ROLE_SUPER_ADMIN)) {
            abort(403, 'Only Super Admins can create new Super Admin accounts.');
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.system-users.index')->with('success', 'Admin user created successfully.');
    }

    public function edit(User $system_user)
    {
        // Prevent standard admins from editing super admins
        if ($system_user->role === User::ROLE_SUPER_ADMIN && !auth()->user()->hasRole(User::ROLE_SUPER_ADMIN)) {
            return redirect()->route('admin.system-users.index')->with('error', 'You cannot edit a Super Admin account.');
        }

        return view('admin.system-users.edit', compact('system_user'));
    }

    public function update(Request $request, User $system_user)
    {
        // Protect super admin from being downgraded by non-super-admins
        if ($system_user->role === User::ROLE_SUPER_ADMIN && !auth()->user()->hasRole(User::ROLE_SUPER_ADMIN)) {
            abort(403, 'Only Super Admins can modify Super Admin accounts.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($system_user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_ADMIN, User::ROLE_MODERATOR])],
        ]);

        // Prevent standard admins from assigning super admin role
        if ($validated['role'] === User::ROLE_SUPER_ADMIN && !auth()->user()->hasRole(User::ROLE_SUPER_ADMIN)) {
            abort(403, 'Only Super Admins can grant Super Admin privileges.');
        }

        $system_user->name = $validated['name'];
        $system_user->email = $validated['email'];
        $system_user->role = $validated['role'];

        if ($request->filled('password')) {
            $system_user->password = Hash::make($validated['password']);
        }

        $system_user->save();

        return redirect()->route('admin.system-users.index')->with('success', 'Admin user updated successfully.');
    }

    public function destroy(User $system_user)
    {
        if ($system_user->id === auth()->id()) {
            return redirect()->route('admin.system-users.index')->with('error', 'You cannot delete yourself.');
        }

        if ($system_user->role === User::ROLE_SUPER_ADMIN && !auth()->user()->hasRole(User::ROLE_SUPER_ADMIN)) {
            return redirect()->route('admin.system-users.index')->with('error', 'You cannot delete a Super Admin.');
        }

        $system_user->delete();

        return redirect()->route('admin.system-users.index')->with('success', 'Admin user removed.');
    }
}
