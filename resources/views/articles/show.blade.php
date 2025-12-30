<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $article->title }}
            </h2>
            <div class="flex space-x-2">
                @can('edit-articles')
                    <a href="{{ route('articles.edit', $article->id) }}" 
                       class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                        Edit Article
                    </a>
                @endcan
                <a href="{{ route('articles.index') }}" 
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Back to Articles
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Featured Image -->
                @if($article->featured_image)
                    <div class="w-full h-64 md:h-80 overflow-hidden rounded-t-lg">
                        <img 
                            src="{{ $article->featured_image }}" 
                            alt="{{ $article->title }}" 
                            class="w-full h-full object-cover"
                        >
                    </div>
                @endif

                <div class="p-6 md:p-8">
                    <!-- Article Meta -->
                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <div class="flex items-center space-x-3 mb-3 md:mb-0">
                            @if($article->category)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $article->category }}
                                </span>
                            @endif
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                @if($article->status == 'published') bg-green-100 text-green-800
                                @elseif($article->status == 'draft') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($article->status) }}
                            </span>
                        </div>
                        
                        <div class="text-sm text-gray-500">
                            {{ $article->created_at->format('F d, Y') }}
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                        {{ $article->title }}
                    </h1>

                    <!-- Author -->
                    <div class="flex items-center mb-6">
                        <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-gray-600 font-medium">By {{ $article->author }}</span>
                    </div>

                    <!-- Tags -->
                    @if($article->tags)
                        <div class="mb-6">
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $tags = array_map('trim', explode(',', $article->tags));
                                @endphp
                                @foreach($tags as $tag)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="prose max-w-none mb-8">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    <!-- Article Stats -->
                    <div class="border-t border-gray-200 pt-6 mt-8">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ strlen($article->content ?? '') }}</div>
                                <div class="text-sm text-gray-500">Characters</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ str_word_count($article->content ?? '') }}</div>
                                <div class="text-sm text-gray-500">Words</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">
                                    {{ $article->created_at->diffForHumans() }}
                                </div>
                                <div class="text-sm text-gray-500">Created</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">
                                    {{ $article->updated_at->diffForHumans() }}
                                </div>
                                <div class="text-sm text-gray-500">Last Updated</div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap justify-between items-center mt-8 pt-6 border-t border-gray-200">
                        <div>
                            <a href="{{ route('articles.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Articles
                            </a>
                        </div>
                        <div class="flex space-x-3 mt-3 md:mt-0">
                            @can('edit-articles')
                                <a href="{{ route('articles.edit', $article->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Article
                                </a>
                            @endcan
                            
                            @can('delete-articles')
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this article?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700">
                                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete Article
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>