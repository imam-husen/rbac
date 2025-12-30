<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Details: {{ $user->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('users.edit', $user->id) }}" 
                   class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                    Edit User
                </a>
                <a href="{{ route('users.index') }}" 
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Back to Users
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- User Profile Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row md:items-start md:space-x-6">
                        <!-- Avatar -->
                        <div class="flex-shrink-0 mb-4 md:mb-0">
                            <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-4xl font-semibold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                                @if($user->id === auth()->id())
                                    <span class="ml-3 text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">You</span>
                                @endif
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $user->email }}</span>
                                </div>
                                
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Member since: {{ $user->created_at->format('F d, Y') }}</span>
                                </div>
                                
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Last updated: {{ $user->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Roles Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Assigned Roles</h3>
                    
                    @if($user->roles->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($user->roles as $role)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium text-gray-900">{{ $role->name }}</span>
                                        <span class="text-xs text-gray-500">ID: {{ $role->id }}</span>
                                    </div>
                                    
                                    @if($role->permissions->count() > 0)
                                        <div class="mt-2">
                                            <p class="text-xs text-gray-500 mb-1">Permissions:</p>
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($role->permissions->take(3) as $permission)
                                                    <span class="text-xs px-1.5 py-0.5 bg-gray-100 text-gray-700 rounded">
                                                        {{ $permission->name }}
                                                    </span>
                                                @endforeach
                                                @if($role->permissions->count() > 3)
                                                    <span class="text-xs text-gray-500">+{{ $role->permissions->count() - 3 }} more</span>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-500 mt-2">No permissions assigned</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No roles assigned</h3>
                            <p class="mt-1 text-sm text-gray-500">This user doesn't have any roles assigned yet.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Direct Permissions Card (Optional) -->
            @if($user->permissions->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Direct Permissions</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($user->permissions as $permission)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $permission->name }}
                                </span>
                            @endforeach
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            These permissions are assigned directly to the user, in addition to role permissions.
                        </p>
                    </div>
                </div>
            @endif

            <!-- User Statistics Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">User Statistics</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">{{ $user->roles->count() }}</div>
                            <div class="text-sm text-gray-500">Roles</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">{{ $user->permissions->count() }}</div>
                            <div class="text-sm text-gray-500">Direct Permissions</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">
                                {{ $user->created_at->diffForHumans() }}
                            </div>
                            <div class="text-sm text-gray-500">Member for</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">
                                {{ $user->id }}
                            </div>
                            <div class="text-sm text-gray-500">User ID</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>