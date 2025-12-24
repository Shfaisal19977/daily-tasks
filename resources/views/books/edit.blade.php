@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-green-500">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            <i class="fas fa-edit text-green-600 mr-3"></i>Edit Book
        </h1>

        <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-book mr-2 text-green-500"></i>Book Title
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Author -->
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user mr-2 text-green-500"></i>Author
                </label>
                <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('author') border-red-500 @enderror">
                @error('author')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Publication Year -->
            <div>
                <label for="publication_year" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar mr-2 text-green-500"></i>Publication Year
                </label>
                <input type="number" name="publication_year" id="publication_year" value="{{ old('publication_year', $book->publication_year) }}" min="1000" max="9999" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('publication_year') border-red-500 @enderror">
                @error('publication_year')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cover Information -->
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-image mr-2 text-green-500"></i>Cover Information
                </h3>
                
                <!-- Cover Color -->
                <div class="mb-4">
                    <label for="cover_color" class="block text-sm font-medium text-gray-700 mb-2">
                        Cover Color
                    </label>
                    <input type="text" name="cover_color" id="cover_color" value="{{ old('cover_color', $book->cover?->color) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('cover_color') border-red-500 @enderror"
                        placeholder="e.g., Blue, Red, Green">
                    @error('cover_color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover Format -->
                <div>
                    <label for="cover_format" class="block text-sm font-medium text-gray-700 mb-2">
                        Cover Format
                    </label>
                    <select name="cover_format" id="cover_format"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition @error('cover_format') border-red-500 @enderror">
                        <option value="">Select format</option>
                        <option value="hardcover" {{ old('cover_format', $book->cover?->format) === 'hardcover' ? 'selected' : '' }}>Hardcover</option>
                        <option value="paperback" {{ old('cover_format', $book->cover?->format) === 'paperback' ? 'selected' : '' }}>Paperback</option>
                        <option value="ebook" {{ old('cover_format', $book->cover?->format) === 'ebook' ? 'selected' : '' }}>E-book</option>
                    </select>
                    @error('cover_format')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Categories -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tags mr-2 text-green-500"></i>Categories
                </label>
                <div class="border border-gray-300 rounded-lg p-4 max-h-48 overflow-y-auto">
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="categories[]" id="category_{{ $category->id }}" 
                                    value="{{ $category->id }}" 
                                    {{ in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'checked' : '' }}
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="category_{{ $category->id }}" class="ml-2 text-sm text-gray-700">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-500">No categories available. <a href="{{ route('categories.create') }}" class="text-green-600 hover:underline">Create one</a></p>
                    @endif
                </div>
                @error('categories.*')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition transform hover:scale-105 font-medium">
                    <i class="fas fa-save mr-2"></i>Update Book
                </button>
                <a href="{{ route('books.show', $book) }}" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition text-center font-medium">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
