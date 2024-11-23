<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|unique:users',
            'foto' => 'nullable|image|max:2048',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,owner,waiters,cook,cleaner',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('user_photos', 'public');
        }

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'no_telp' => 'required|string|max:15',
            'foto' => 'nullable|image|max:2048',
            'role' => 'required|in:admin,owner,waiters,cook,cleaner',
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete('public/'.$user->foto);
            }
            $validated['foto'] = $request->file('foto')->store('user_photos', 'public');
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $user = User::findOrFail($id);

        if ($user->foto) {
            Storage::delete('public/'.$user->foto);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
