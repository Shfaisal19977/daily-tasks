@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Book Header -->
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-green-500">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $book->title }}</h1>
                <div class="space-y-3">
                    <div class="flex items-center text-lg text-gray-700">
                        <i class="fas fa-user text-green-600 mr-3 w-6"></i>
                        <span class="font-medium">{{ $book->author }}</span>
                    </div>
                    <div class="flex items-center text-lg text-gray-700">
                        <i class="fas fa-calendar text-green-600 mr-3 w-6"></i>
                        <span>{{ $book->publication_year }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-clock text-green-600 mr-3 w-6"></i>
                        <span>Added {{ $book->created_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('books.edit', $book) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Cover Information -->
    @if($book->cover)
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                <i class="fas fa-image text-blue-600 mr-2"></i>Cover Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($book->cover->color)
                    <div>
                        <span class="text-sm font-medium text-gray-600">Color:</span>
                        <span class="ml-2 text-gray-800">{{ $book->cover->color }}</span>
                    </div>
                @endif
                @if($book->cover->format)
                    <div>
                        <span class="text-sm font-medium text-gray-600">Format:</span>
                        <span class="ml-2 text-gray-800 capitalize">{{ $book->cover->format }}</span>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Categories -->
    @if($book->categories->count() > 0)
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                <i class="fas fa-tags text-purple-600 mr-2"></i>Categories
            </h2>
            <div class="flex flex-wrap gap-2">
                @foreach($book->categories as $category)
                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Reviews Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            <i class="fas fa-star text-yellow-600 mr-2"></i>Reviews
        </h2>

        <!-- Add Review Form -->
        <div class="bg-gray-50 p-6 rounded-lg mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Add a Review</h3>
            <form action="{{ route('books.reviews.store', $book) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="reviewer_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Your Name
                    </label>
                    <input type="text" name="reviewer_name" id="reviewer_name" value="{{ old('reviewer_name') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('reviewer_name') border-red-500 @enderror">
                    @error('reviewer_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">
                        Rating (1-5)
                    </label>
                    <select name="rating" id="rating" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('rating') border-red-500 @enderror">
                        <option value="">Select rating</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                {{ $i }} {{ $i === 1 ? 'star' : 'stars' }}
                            </option>
                        @endfor
                    </select>
                    @error('rating')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                        Comment
                    </label>
                    <textarea name="comment" id="comment" rows="4" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('comment') border-red-500 @enderror">{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600 transition font-medium">
                    <i class="fas fa-plus mr-2"></i>Submit Review
                </button>
            </form>
        </div>

        <!-- Reviews List -->
        @if($book->reviews->count() > 0)
            <div class="space-y-4">
                @foreach($book->reviews as $review)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $review->reviewer_name }}</h4>
                                <div class="flex items-center mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                    @endfor
                                    <span class="ml-2 text-sm text-gray-600">({{ $review->rating }}/5)</span>
                                </div>
                            </div>
                            <form action="{{ route('books.reviews.destroy', [$book, $review]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        <p class="text-gray-700 mt-2">{{ $review->comment }}</p>
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-clock mr-1"></i>{{ $review->created_at->format('F d, Y') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-comment-slash text-4xl mb-4"></i>
                <p>No reviews yet. Be the first to review this book!</p>
            </div>
        @endif
    </div>
</div>
@endsection
