<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
/* public function __construct()
    {
        $this->middleware('permission:roles')->only(['index', 'edit', 'create', 'destroy']);
    } */
   
    public function __construct()
    {
        $this->middleware('permission:view-roles|manage-all')->only('index');
        $this->middleware('permission:create-roles|manage-all')->only(['create','store']);
        $this->middleware('permission:edit-roles|manage-all')->only(['edit','update']);
        $this->middleware('permission:delete-roles|manage-all')->only('destroy');
    }
   
    public function index()
    {
        return view('roles.list', [
            'roles' => Role::orderBy('name', 'ASC')->paginate(10)
        ]);
    }

    public function create()
    {
        $permissions = Permission::orderBy('name', 'asc')->get();
        return view('roles.create', [
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id', // Validasi bahwa ID permission ada di database
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Create role
        $role = Role::create([
            'name' => $request->name,
        ]);

        // Assign permissions if any
        if (!empty($request->permissions)) {
            // Ambil permission berdasarkan ID yang dikirim
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            
            // Berikan permission ke role
            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission->name);
            }
            
            // Atau bisa menggunakan syncPermissions (lebih efisien)
            // $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role added successfully.');
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('roles.edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        // Update role name
        $role->update([
            'name' => $request->name,
        ]);

        // Sync permissions
        $permissionIds = $request->permissions ?? [];
        
        // Ambil permission berdasarkan ID
        $permissions = Permission::whereIn('id', $permissionIds)->get();
        
        // Sync permissions ke role
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        
        // Cek jika role memiliki users
        if ($role->users->count() > 0) {
            return redirect()->route('roles.index')
                ->with('error', 'Cannot delete role because it has assigned users.');
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}