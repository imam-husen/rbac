<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Permission: {{ $permission->name }}
            </h2>
            <a href="{{ route('permissions.index') }}" 
               class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Permission Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Permission Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    value="{{ old('name', $permission->name) }}" 
                                    placeholder="Enter permission name (e.g., create-user, edit-post)"
                                    class="mt-1 block w-full md:w-1/2 border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                    required
                                >
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">
                                    Use lowercase with hyphens (e.g., view-reports, manage-users)
                                </p>
                            </div>

                            <!-- Current Roles Assignment (Read-only) -->
                            @if($permission->roles && $permission->roles->count() > 0)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h3 class="text-sm font-medium text-gray-700 mb-3">
                                        Assigned to Roles
                                    </h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($permission->roles as $role)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <p class="mt-3 text-sm text-gray-500">
                                        This permission is assigned to <span class="font-medium">{{ $permission->roles->count() }}</span> role(s).
                                        To change role assignments, please edit the roles individually.
                                    </p>
                                </div>
                            @else
                                <div class="border border-gray-200 rounded-lg p-4 bg-yellow-50">
                                    <div class="flex">
                                        <svg class="h-5 w-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <div>
                                            <h3 class="text-sm font-medium text-yellow-800">Not Assigned to Any Role</h3>
                                            <p class="text-sm text-yellow-700 mt-1">
                                                This permission is not currently assigned to any role. 
                                                To assign this permission, edit the relevant roles.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Permission Information -->
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                <h3 class="text-sm font-medium text-gray-700 mb-3">
                                    Permission Information
                                </h3>
                                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Created</dt>
                                        <dd class="text-sm text-gray-900">
                                            @if($permission->created_at)
                                                {{ $permission->created_at->format('F d, Y H:i') }}
                                            @else
                                                <span class="text-gray-400">Not available</span>
                                            @endif
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Last Updated</dt>
                                        <dd class="text-sm text-gray-900">
                                            @if($permission->updated_at)
                                                {{ $permission->updated_at->format('F d, Y H:i') }}
                                            @else
                                                <span class="text-gray-400">Not available</span>
                                            @endif
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Guard Name</dt>
                                        <dd class="text-sm text-gray-900">
                                            {{ $permission->guard_name ?? 'web' }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Permission ID</dt>
                                        <dd class="text-sm text-gray-900">{{ $permission->id }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Warning for Admin Permission -->
                            @php
                                $currentPermissionName = strtolower($permission->name ?? '');
                                $criticalPermissions = ['admin', 'super-admin', 'manage-all', 'administrator'];
                            @endphp
                            
                            @if(in_array($currentPermissionName, $criticalPermissions))
                                <div class="border border-red-200 rounded-lg p-4 bg-red-50">
                                    <div class="flex">
                                        <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <div>
                                            <h3 class="text-sm font-medium text-red-800">Important Notice</h3>
                                            <p class="text-sm text-red-700 mt-1">
                                                This is a critical system permission. Changing its name may affect system functionality.
                                                Ensure you update all role assignments and code references accordingly.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                <div>
                                    <a href="{{ route('permissions.index') }}" 
                                       class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                        Cancel
                                    </a>
                                </div>
                                <div class="flex space-x-3">
                                    <button 
                                        type="reset" 
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500"
                                    >
                                        Reset
                                    </button>
                                    <button 
                                        type="submit" 
                                        class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black"
                                    >
                                        Update Permission
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Form Validation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const nameInput = document.getElementById('name');
            
            // Auto-format permission name
            if (nameInput) {
                nameInput.addEventListener('blur', function() {
                    let value = this.value.trim();
                    if (value) {
                        // Convert to lowercase, replace spaces with hyphens, remove special chars
                        value = value.toLowerCase()
                            .replace(/\s+/g, '-')
                            .replace(/[^a-z0-9\-]/g, '')
                            .replace(/\-+/g, '-');
                        
                        if (value !== this.value) {
                            this.value = value;
                        }
                    }
                });
                
                // Confirm before submitting for critical permissions
                form.addEventListener('submit', function(e) {
                    const permissionName = nameInput.value.trim().toLowerCase();
                    const criticalPermissions = ['admin', 'super-admin', 'manage-all', 'administrator'];
                    const currentName = "{{ strtolower($permission->name ?? '') }}";
                    
                    if (permissionName !== currentName && criticalPermissions.includes(permissionName)) {
                        const confirmed = confirm(
                            'Warning: You are changing a critical system permission name.\n\n' +
                            'This may break existing functionality if not updated properly.\n\n' +
                            'Are you sure you want to continue?'
                        );
                        
                        if (!confirmed) {
                            e.preventDefault();
                            return false;
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>