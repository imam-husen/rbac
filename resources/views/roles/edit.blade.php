<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Role: {{ $role->name }}
            </h2>
            <a href="{{ route('roles.index') }}" class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">Back</a>
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
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Role Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Role Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    value="{{ old('name', $role->name) }}" 
                                    placeholder="Enter role name"
                                    class="mt-1 block w-full md:w-1/2 border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                    required
                                >
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Permissions Section -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    Permissions
                                </label>
                                
                                @error('permissions')
                                    <p class="mb-3 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                
                                @error('permissions.*')
                                    <p class="mb-3 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                @if($permissions->count() > 0)
                                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-sm font-medium text-gray-600">
                                                Select permissions for this role
                                            </span>
                                            <button 
                                                type="button" 
                                                onclick="toggleAllPermissions()"
                                                class="text-sm text-blue-600 hover:text-blue-800"
                                            >
                                                Toggle All
                                            </button>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                            @foreach($permissions as $permission)
                                                <div class="flex items-center">
                                                    <input 
                                                        type="checkbox" 
                                                        name="permissions[]" 
                                                        value="{{ $permission->id }}"
                                                        id="perm_{{ $permission->id }}"
                                                        class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded"
                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                        {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
                                                    >
                                                    <label 
                                                        for="perm_{{ $permission->id }}" 
                                                        class="ml-2 text-sm text-gray-700"
                                                    >
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <p class="text-sm text-gray-500">
                                                <span class="font-medium">{{ $role->permissions->count() }}</span> of 
                                                <span class="font-medium">{{ $permissions->count() }}</span> permissions selected
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="border border-gray-200 rounded-lg p-6 text-center bg-gray-50">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-600">No permissions found.</p>
                                        <p class="text-xs text-gray-500 mt-1">Please create permissions first to assign them to roles.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Current Permissions Summary (Optional) -->
                            @if($role->permissions->count() > 0)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h3 class="text-sm font-medium text-gray-700 mb-3">
                                        Current Permissions for this Role
                                    </h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($role->permissions as $permission)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                <div>
                                    <a href="{{ route('roles.index') }}" 
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
                                        Update Role
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Toggle All Permissions -->
    <script>
        function toggleAllPermissions() {
            const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = !allChecked;
            });
            
            updateSelectedCount();
        }
        
        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('input[name="permissions[]"]:checked');
            const total = document.querySelectorAll('input[name="permissions[]"]').length;
            
            // Update the count display if it exists
            const countElement = document.querySelector('.selected-count');
            if (countElement) {
                countElement.textContent = checkboxes.length;
            }
        }
        
        // Initialize and add event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedCount);
            });
            
            // Initial count
            updateSelectedCount();
        });
    </script>
</x-app-layout>