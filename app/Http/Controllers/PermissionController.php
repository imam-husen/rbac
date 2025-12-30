<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

/* public function __construct()
    {
        $this->middleware('permission:articles')->only(['index', 'edit', 'create', 'destroy']);
    } */
    public function __construct()
    {
        $this->middleware('permission:view-permissions|manage-all')->only('index');
        $this->middleware('permission:create-permissions|manage-all')->only(['create','store']);
        $this->middleware('permission:edit-permissions|manage-all')->only(['edit','update']);
        $this->middleware('permission:delete-permissions|manage-all')->only('destroy');
    }
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(10);

        return view('permissions.list', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission added successfully.');
    }

    public function edit($id)
    {
        $permission = Permission::findById($id);
        
        if (!$permission) {
            return redirect()->route('permissions.index')
                ->with('error', 'Permission not found.');
        }

        return view('permissions.edit', [
            'permission' => $permission // Ubah jadi singular
        ]);
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findById($id);
        
        if (!$permission) {
            return redirect()->route('permissions.index')
                ->with('error', 'Permission not found.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    public function destroy($id)
    {
        $permission = Permission::findById($id);
        
        if (!$permission) {
            return redirect()->route('permissions.index')
                ->with('error', 'Permission not found.');
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
} 