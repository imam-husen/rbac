<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles Management') }}
            </h2>
            @can('create-roles')
            <a href="{{ route('roles.create') }}" class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                Create New Role
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @can('view-roles')
                    @if($roles->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Permissions
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created At
                                        </th>
                                        @canany(['edit-roles', 'delete-roles'])
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($roles as $index => $role)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ ($roles->currentPage() - 1) * $roles->perPage() + $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $role->name }}
                                                @if($role->name === 'admin')
                                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                                        System Role
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($role->permissions->count() > 0)
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach($role->permissions->take(3) as $permission)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                {{ $permission->name }}
                                                            </span>
                                                        @endforeach
                                                        @if($role->permissions->count() > 3)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                                +{{ $role->permissions->count() - 3 }} more
                                                            </span>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-gray-500 text-sm">No permissions</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $role->created_at->format('d M Y') }}
                                            </td>
                                            @canany(['edit-roles', 'delete-roles'])
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    @can('edit-roles')
                                                    <a href="{{ route('roles.edit', $role->id) }}" 
                                                       class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                        Edit
                                                    </a>
                                                    @endcan
                                                    
                                                    @can('delete-roles')
                                                    <!-- Delete Button with Confirmation -->
                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" 
                                                          onsubmit="return confirm('Are you sure you want to delete this role? This action cannot be undone.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500
                                                                       {{ in_array($role->name, ['admin', 'user']) ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                                {{ in_array($role->name, ['admin', 'user']) ? 'disabled' : '' }}>
                                                            Delete
                                                        </button>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $roles->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No roles found</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by creating a new role.</p>
                            @can('create-roles')
                            <div class="mt-6">
                                <a href="{{ route('roles.create') }}" class="inline-flex items-center px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                                    Create New Role
                                </a>
                            </div>
                            @endcan
                        </div>
                    @endif
                    @else
                    <!-- Access Denied Message -->
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-red-800">Access Denied</h3>
                        <p class="mt-1 text-red-700">
                            You don't have permission to view roles. 
                            Please contact your administrator if you need access.
                        </p>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>