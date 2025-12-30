<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('permission:users')->only(['index', 'edit', 'create', 'destroy']);
    } */
    /**
     * Display a listing of the resource.
     */

public function __construct()
    {
        $this->middleware('permission:view-users|manage-all')->only(['index','show']);
        $this->middleware('permission:create-users|manage-all')->only(['create','store']);
        $this->middleware('permission:edit-users|manage-all')->only(['edit','update']);
        $this->middleware('permission:delete-users|manage-all')->only(['destroy']);
    }
    public function index()
{
    // Gunakan paginate() bukan get()
    $users = User::with('roles')->paginate(6); // 10 item per halaman
    
    return view('users.list', compact('users'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'array',
        ]);

        // Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign roles jika ada
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validasi
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'roles' => 'array',
        ]);

        // Update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        // Sync roles
        $user->syncRoles($request->roles ?? []);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $user = User::findOrFail($id);
    
    // Jangan hapus diri sendiri
    if ($user->id === auth()->id()) {
        return redirect()->route('users.index') // <-- Perbaiki ini
            ->with('error', 'You cannot delete yourself.');
    }

    $user->delete();

    return redirect()->route('users.index')
        ->with('success', 'User deleted successfully.');
}
}