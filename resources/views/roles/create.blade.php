<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Role
            </h2>
            <a href="{{ route('roles.index') }}" class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div>
                            <label for="name" class="text-sm font-medium">Role Name</label>
                            <div class="my-3">
                                <input value="{{ old('name') }}" placeholder="Enter Role Name" type="text" name="name" id="name" class="mt-1 block w-1/2 border-gray-300 shadow-sm rounded-lg">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="text-sm font-medium block mb-2">Permissions</label>
                                @error('permissions')
                                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                                @enderror
                                @error('permissions.*')
                                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                                @enderror
                                
                                <div class="grid grid-cols-4 gap-4">
                                    @if($permissions->count() > 0)
                                        @foreach ($permissions as $permission)
                                            <div class="flex items-center">
                                                <input type="checkbox" 
                                                       name="permissions[]" 
                                                       value="{{ $permission->id }}"
                                                       id="perm_{{ $permission->id }}"
                                                       {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
                                                       class="mr-2">
                                                <label for="perm_{{ $permission->id }}" class="text-sm">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-gray-500 text-sm">No permissions found. Please create permissions first.</p>
                                    @endif
                                </div>
                            </div>
                            
                            <button type="submit" class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                                Create Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>