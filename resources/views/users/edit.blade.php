<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User: {{ $user->name }}
            </h2>
            <a href="{{ route('users.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" value="{{ $user->name }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                       required>
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                       required>
                            </div>
                            
                            <!-- Password (Optional) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Password (Leave blank to keep current)</label>
                                <input type="password" name="password" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                            </div>
                            
                            <!-- Current Roles -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Roles</label>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($user->roles as $role)
                                        <span class="px-2 py-1 text-sm bg-gray-100 text-gray-800 rounded">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Assign Roles -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Assign Roles</label>
                                <div class="space-y-2">
                                    @foreach($roles as $role)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="roles[]" value="{{ $role->name }}" 
                                                   id="role_{{ $role->id }}" 
                                                   class="mr-2"
                                                   {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                            <label for="role_{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="pt-4 flex justify-between">
                                <button type="submit" 
                                        class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800">
                                    Update User
                                </button>
                                
                                <!-- Delete Button -->
                                @if($user->id != auth()->id())
                                    <button type="button" 
                                            onclick="if(confirm('Are you sure?')) { document.getElementById('delete-form').submit(); }"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                        Delete User
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                    
                    <!-- Hidden Delete Form -->
                    @if($user->id != auth()->id())
                        <form id="delete-form" action="{{ route('users.destroy', $user->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>