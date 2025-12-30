<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
                @if(isset($status))
                    <span class="text-sm font-normal text-gray-600">({{ ucfirst($status) }})</span>
                @endif
                @if(isset($category))
                    <span class="text-sm font-normal text-gray-600">(Category: {{ $category }})</span>
                @endif
            </h2>
            @can('create-articles')
                <a href="{{ route('articles.create') }}" class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                    Create New Article
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Form -->
            <div class="mb-6">
                <form action="{{ route('articles.search') }}" method="GET" class="flex gap-2">
                    <input 
                        type="text" 
                        name="query" 
                        value="{{ request('query') }}" 
                        placeholder="Search articles..."
                        class="flex-1 border border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black px-3 py-2"
                    >
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black"
                    >
                        Search
                    </button>
                </form>
            </div>

            <!-- Success/Error Messages -->
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

            <!-- Articles List -->
            @if(isset($articles) && $articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($articles as $article)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow flex flex-col">
                            {{-- Image container with fixed height so original image size won't show --}}
                            @if($article->featured_image)
                                <div class="w-full h-48 overflow-hidden bg-gray-100 rounded-t-lg">
                                    <img 
                                        src="{{ $article->featured_image }}" 
                                        alt="{{ $article->title }}" 
                                        loading="lazy"
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                            @else
                                <div class="w-full h-48 flex items-center justify-center bg-gray-100 rounded-t-lg text-gray-400">
                                    <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3v4M8 3v4" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-sm font-medium text-gray-500">{{ $article->category ?? 'Uncategorized' }}</span>
                                    <span class="text-xs px-2 py-1 rounded-full 
                                        @if($article->status == 'published') bg-green-100 text-green-800
                                        @elseif($article->status == 'draft') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </div>

                                {{-- Title (max 2 lines) --}}
                                <h3 class="text-lg font-semibold text-gray-900 mb-2"
                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $article->title }}
                                </h3>

                                {{-- Content excerpt: prefer content, fallback to excerpt, truncated --}}
                                <p class="text-sm text-gray-600 mb-4"
                                   style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($article->content ?? $article->excerpt ?? ''), 180) }}
                                </p>

                                <div class="mt-auto">
                                    <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                                        <span>By {{ $article->author }}</span>
                                        <span>{{ optional($article->created_at)->format('M d, Y') }}</span>
                                    </div>

                                    <div class="flex space-x-2">
                                        {{-- View button - semua role bisa view (karena semua punya view-articles) --}}
                                        <a href="{{ route('articles.show', $article->id) }}" 
                                           class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                            View
                                        </a>
                                        
                                        {{-- Edit button - hanya untuk yang punya permission edit-articles --}}
                                        @can('edit-articles')
                                            <a href="{{ route('articles.edit', $article->id) }}" 
                                               class="px-3 py-1 bg-gray-600 text-white rounded hover:bg-gray-700 text-sm">
                                                Edit
                                            </a>
                                        @endcan
                                        
                                        {{-- Delete button - hanya untuk yang punya permission delete-articles --}}
                                        @can('delete-articles')
                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No articles found</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new article.</p>
                    <div class="mt-6">
                        @can('create-articles')
                            <a href="{{ route('articles.create') }}" class="inline-flex items-center px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                                Create New Article
                            </a>
                        @endcan
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>