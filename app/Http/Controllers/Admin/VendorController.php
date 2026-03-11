<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'vendor');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $vendors = $query->withCount('products')->paginate(15);

        return view('admin.vendors', [
            'vendors' => $vendors,
        ]);
    }

    public function show(User $vendor)
    {
        if ($vendor->role !== 'vendor') {
            return back()->withErrors('User is not a vendor');
        }

        $vendor->load('products', 'wallet');
        return view('admin.vendors-detail', ['vendor' => $vendor]);
    }

    public function destroy(User $vendor)
    {
        if ($vendor->role !== 'vendor') {
            return back()->withErrors('User is not a vendor');
        }

        $vendor->delete();
        return redirect()->route('admin.vendors.index')->with('success', 'Vendor deleted successfully');
    }

    public function create()
    {
        return view('admin.vendors-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'vendor';

        $vendor = User::create($validated);
        $vendor->wallet()->create(['balance' => 0]);

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor created successfully');
    }

    public function edit(User $vendor)
    {
        if ($vendor->role !== 'vendor') {
            return back()->withErrors('Can only edit vendors');
        }

        return view('admin.vendors-edit', ['vendor' => $vendor]);
    }

    public function update(Request $request, User $vendor)
    {
        if ($vendor->role !== 'vendor') {
            return back()->withErrors('Can only edit vendors');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $vendor->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $vendor->update($validated);

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor updated successfully');
    }
}