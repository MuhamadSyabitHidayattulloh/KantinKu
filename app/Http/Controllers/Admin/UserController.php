<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->with('wallet')->paginate(15);

        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function show(User $user)
    {
        $user->load('wallet', 'orders');
        return view('admin.users-detail', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'user') {
            return back()->withErrors('Only regular users can be deleted');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    public function create()
    {
        return view('admin.users-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'user';

        $user = User::create($validated);
        $user->wallet()->create(['balance' => 0]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        if ($user->role !== 'user') {
            return back()->withErrors('Can only edit regular users');
        }

        return view('admin.users-edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        if ($user->role !== 'user') {
            return back()->withErrors('Can only edit regular users');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }
}


