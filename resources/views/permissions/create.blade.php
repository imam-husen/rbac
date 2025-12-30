<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permissions Create
            </h2>
            <a href="{{ route('permissions.index') }}" 
               class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can('create-permissions')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('permissions.store') }}" method="POST">
                        @csrf

                        <div>
                            <label for="name" class="text-sm font-medium">Name</label>
                            <div class="my-3">
                                <input value="{{ old('name') }}" 
                                       placeholder="Enter Name" 
                                       type="text" 
                                       name="name" 
                                       id="name" 
                                       class="mt-1 block w-full md:w-1/2 border-gray-300 shadow-sm rounded-lg">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <button type="submit" 
                                    class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <h3 class="text-lg font-medium text-red-800">Access Denied</h3>
                        </div>
                        <p class="mt-2 text-red-700">
                            You don't have permission to create new permissions. 
                            Please contact your administrator if you need access.
                        </p>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
</x-app-layout>