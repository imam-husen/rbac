<x-app-layout>
    <x-slot name="header">
        @can
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Article
            </h2>
            <a href="{{ route('articles.index') }}" class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                Back to Articles
            </a>
        </div>
        @endcan
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
                    <form action="{{ route('articles.store') }}" method="POST">
                        @csrf

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
                                    value="{{ old('title') }}" 
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
                                    rows="10"
                                    placeholder="Write your article content here..."
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                    required
                                >{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">
                                    You can use markdown or HTML formatting in your content.
                                </p>
                            </div>

                            <!-- Author Field -->
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                                    Author Name
                                </label>
                                <input 
                                    type="text" 
                                    name="author" 
                                    id="author" 
                                    value="{{ old('author', Auth::user()->name) }}" 
                                    placeholder="Enter author name"
                                    class="mt-1 block w-full md:w-1/2 border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                >
                                @error('author')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">
                                    Leave empty to use your name as the author.
                                </p>
                            </div>

                            <!-- Additional Fields (Optional) -->
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
                                        <option value="technology" {{ old('category') == 'technology' ? 'selected' : '' }}>Technology</option>
                                        <option value="business" {{ old('category') == 'business' ? 'selected' : '' }}>Business</option>
                                        <option value="health" {{ old('category') == 'health' ? 'selected' : '' }}>Health</option>
                                        <option value="education" {{ old('category') == 'education' ? 'selected' : '' }}>Education</option>
                                        <option value="lifestyle" {{ old('category') == 'lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                                        <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('category')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Status Field -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        Status
                                    </label>
                                    <select 
                                        name="status" 
                                        id="status"
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                    >
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
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
                                    value="{{ old('tags') }}" 
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

                            <!-- Featured Image (Optional) -->
                            <div>
                                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Featured Image URL (Optional)
                                </label>
                                <input 
                                    type="url" 
                                    name="featured_image" 
                                    id="featured_image" 
                                    value="{{ old('featured_image') }}" 
                                    placeholder="https://example.com/image.jpg"
                                    class="mt-1 block w-full md:w-2/3 border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black"
                                >
                                @error('featured_image')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">
                                    Enter a direct URL to an image for your article.
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                <div>
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
                                        Clear Form
                                    </button>
                                    <button 
                                        type="submit" 
                                        class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black"
                                    >
                                        Create Article
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Character Count -->
    <script>
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
                    
                    if (length > 5000) {
                        counter.className = 'text-sm text-red-500 mt-1';
                    } else if (length > 3000) {
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