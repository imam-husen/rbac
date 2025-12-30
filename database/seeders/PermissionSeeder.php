<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // users
            'view-users', 'create-users', 'edit-users', 'delete-users',
            // roles
            'view-roles', 'create-roles', 'edit-roles', 'delete-roles',
            // permissions
            'view-permissions', 'create-permissions', 'edit-permissions', 'delete-permissions',
            // articles
            'view-articles', 'create-articles', 'edit-articles', 'delete-articles',
            // admin helper
            'manage-all',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $user = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Assign permissions
        $admin->syncPermissions($permissions);
        $editor->syncPermissions(['view-articles', 'create-articles', 'edit-articles', 'view-users']);
        $user->syncPermissions(['view-articles']);
    }
}