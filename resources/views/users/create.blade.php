<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New User
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
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                       required>
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                       required>
                            </div>
                            
                            <!-- Password -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                       required>
                            </div>
                            
                            <!-- Roles -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Assign Roles</label>
                                <div class="space-y-2">
                                    @foreach($roles as $role)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="roles[]" value="{{ $role->name }}" 
                                                   id="role_{{ $role->id }}" class="mr-2">
                                            <label for="role_{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit" 
                                        class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800">
                                    Create User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>