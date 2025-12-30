<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users Management
            </h2>
            @can('create-users')
            <a href="{{ route('users.create') }}" 
               class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                Add New User
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Users Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @can('view-users')
                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Roles
                                        </th>
                                        @canany(['edit-users', 'delete-users'])
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $index => $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                                        @if($user->id == auth()->id())
                                                            <span class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                                                You
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $user->email }}
                                                @if($user->hasRole('admin'))
                                                    <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">
                                                        Admin
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($user->roles as $role)
                                                        <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                            @if($role->name === 'admin') bg-red-100 text-red-800
                                                            @elseif($role->name === 'editor') bg-purple-100 text-purple-800
                                                            @else bg-gray-100 text-gray-800 @endif">
                                                            {{ $role->name }}
                                                        </span>
                                                    @endforeach
                                                    @if($user->roles->count() === 0)
                                                        <span class="text-gray-500 text-sm">No roles assigned</span>
                                                    @endif
                                                </div>
                                            </td>
                                            @canany(['edit-users', 'delete-users'])
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                @can('edit-users')
                                                <a href="{{ route('users.edit', $user->id) }}" 
                                                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    Edit
                                                </a>
                                                @endcan
                                                
                                                @can('delete-users')
                                                @if($user->id != auth()->id())
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" 
                                                          class="inline" 
                                                          onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500
                                                                       {{ $user->hasRole('admin') ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                                {{ $user->hasRole('admin') ? 'disabled' : '' }}>
                                                            Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="px-3 py-1 text-gray-400 text-sm">Cannot delete yourself</span>
                                                @endif
                                                @endcan
                                            </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION - FIXED VERSION -->
                        @if(method_exists($users, 'hasPages') && $users->hasPages())
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                        @endif
                        
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No users found</h3>
                            <p class="mt-2 text-gray-500">Get started by creating a new user.</p>
                            @can('create-users')
                            <div class="mt-6">
                                <a href="{{ route('users.create') }}" 
                                   class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                                    Add New User
                                </a>
                            </div>
                            @endcan
                        </div>
                    @endif
                    @else
                    <!-- Access Denied Message -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-red-800">Access Denied</h3>
                        <p class="mt-2 text-red-700 max-w-md mx-auto">
                            You don't have permission to view users. 
                            Only administrators and users with proper permissions can access this page.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('dashboard') }}" 
                               class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                                Return to Dashboard
                            </a>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>