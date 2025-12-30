<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Article: {{ $article->title }}
            </h2>
            <a href="{{ route('articles.index') }}" 
               class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                Back to Articles
            </a>
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
                    <form action="{{ route('articles.update', $article->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Title Field -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Article Title <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    value="{{ old('title', $article->title) }}" 
                                    placeholder="Enter article title"
                                    class="mt-1 block w-full md:w-2/3 border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                    required
                                >
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Content Field -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                    Content <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    name="content" 
                                    id="content" 
                                    rows="15"
                                    placeholder="Write your article content here..."
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                    required
                                >{{ old('content', $article->content) }}</textarea>
                                @error('content')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Author Field -->
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                                    Author Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="author" 
                                    id="author" 
                                    value="{{ old('author', $article->author) }}" 
                                    placeholder="Enter author name"
                                    class="mt-1 block w-full md:w-1/2 border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                    required
                                >
                                @error('author')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Additional Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Category Field -->
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                        Category
                                    </label>
                                    <select 
                                        name="category" 
                                        id="category"
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                    >
                                        <option value="">Select a category</option>
                                        <option value="technology" {{ old('category', $article->category) == 'technology' ? 'selected' : '' }}>Technology</option>
                                        <option value="business" {{ old('category', $article->category) == 'business' ? 'selected' : '' }}>Business</option>
                                        <option value="health" {{ old('category', $article->category) == 'health' ? 'selected' : '' }}>Health</option>
                                        <option value="education" {{ old('category', $article->category) == 'education' ? 'selected' : '' }}>Education</option>
                                        <option value="lifestyle" {{ old('category', $article->category) == 'lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                                        <option value="other" {{ old('category', $article->category) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('category')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Status Field -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select 
                                        name="status" 
                                        id="status"
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                        required
                                    >
                                        <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tags Field -->
                            <div>
                                <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tags (comma separated)
                                </label>
                                <input 
                                    type="text" 
                                    name="tags" 
                                    id="tags" 
                                    value="{{ old('tags', $article->tags) }}" 
                                    placeholder="e.g., laravel, php, web-development"
                                    class="mt-1 block w-full md:w-2/3 border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                >
                                @error('tags')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">
                                    Separate multiple tags with commas.
                                </p>
                            </div>

                            <!-- Featured Image -->
                            <div>
                                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Featured Image URL
                                </label>
                                <input 
                                    type="url" 
                                    name="featured_image" 
                                    id="featured_image" 
                                    value="{{ old('featured_image', $article->featured_image) }}" 
                                    placeholder="https://example.com/image.jpg"
                                    class="mt-1 block w-full md:w-2/3 border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                >
                                @error('featured_image')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                
                                <!-- Preview current image if exists -->
                                @if($article->featured_image)
                                    <div class="mt-3">
                                        <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                                        <div class="w-48 h-32 overflow-hidden rounded-lg border border-gray-200">
                                            <img 
                                                src="{{ $article->featured_image }}" 
                                                alt="Current featured image" 
                                                class="w-full h-full object-cover"
                                                onerror="this.style.display='none';"
                                            >
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Article Information -->
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                <h3 class="text-sm font-medium text-gray-700 mb-3">
                                    Article Information
                                </h3>
                                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Created</dt>
                                        <dd class="text-sm text-gray-900">
                                            {{ $article->created_at ? $article->created_at->format('F d, Y H:i') : 'N/A' }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Last Updated</dt>
                                        <dd class="text-sm text-gray-900">
                                            {{ $article->updated_at ? $article->updated_at->format('F d, Y H:i') : 'N/A' }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Article ID</dt>
                                        <dd class="text-sm text-gray-900">{{ $article->id }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500 uppercase">Content Length</dt>
                                        <dd class="text-sm text-gray-900">{{ strlen($article->content ?? '') }} characters</dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                <div>
                                    <a href="{{ route('articles.show', $article->id) }}" 
                                       class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 mr-3">
                                        View Article
                                    </a>
                                    <a href="{{ route('articles.index') }}" 
                                       class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                        Cancel
                                    </a>
                                </div>
                                <div class="flex space-x-3">
                                    <button 
                                        type="reset" 
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500"
                                    >
                                        Reset Changes
                                    </button>
                                    <button 
                                        type="submit" 
                                        class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black"
                                    >
                                        Update Article
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Delete Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="border border-red-200 rounded-lg p-4 bg-red-50">
                            <div class="flex items-start">
                                <svg class="h-5 w-5 text-red-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                <div class="flex-1">
                                    <h3 class="text-sm font-medium text-red-800">Danger Zone</h3>
                                    <p class="text-sm text-red-700 mt-1">
                                        Once you delete this article, there is no going back. Please be certain.
                                    </p>
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" 
                                          onsubmit="return confirmDelete()" class="mt-3">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 text-sm"
                                        >
                                            Delete This Article
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Confirmation and Character Count -->
    <script>
        function confirmDelete() {
            const articleTitle = "{{ addslashes($article->title) }}";
            return confirm(`Are you absolutely sure you want to delete "${articleTitle}"?\n\nThis action cannot be undone.`);
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const contentTextarea = document.getElementById('content');
            const titleInput = document.getElementById('title');
            
            // Create character counter for content
            if (contentTextarea) {
                const counter = document.createElement('div');
                counter.className = 'text-sm text-gray-500 mt-1';
                counter.id = 'content-counter';
                contentTextarea.parentNode.appendChild(counter);
                
                function updateCounter() {
                    const length = contentTextarea.value.length;
                    counter.textContent = `${length} characters`;
                    
                    if (length > 10000) {
                        counter.className = 'text-sm text-red-500 mt-1';
                    } else if (length > 5000) {
                        counter.className = 'text-sm text-yellow-500 mt-1';
                    } else {
                        counter.className = 'text-sm text-gray-500 mt-1';
                    }
                }
                
                contentTextarea.addEventListener('input', updateCounter);
                updateCounter(); // Initial count
            }
            
            // Create character counter for title
            if (titleInput) {
                const titleCounter = document.createElement('div');
                titleCounter.className = 'text-sm text-gray-500 mt-1';
                titleCounter.id = 'title-counter';
                titleInput.parentNode.appendChild(titleCounter);
                
                function updateTitleCounter() {
                    const length = titleInput.value.length;
                    titleCounter.textContent = `${length}/100 characters`;
                    
                    if (length > 100) {
                        titleCounter.className = 'text-sm text-red-500 mt-1';
                    } else if (length > 80) {
                        titleCounter.className = 'text-sm text-yellow-500 mt-1';
                    } else {
                        titleCounter.className = 'text-sm text-gray-500 mt-1';
                    }
                }
                
                titleInput.addEventListener('input', updateTitleCounter);
                updateTitleCounter(); // Initial count
            }
        });
    </script>
</x-app-layout>