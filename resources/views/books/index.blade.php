@extends('layouts.app')

@section('title', 'Books')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-book text-green-600 mr-3"></i>Books
            </h1>
            <p class="text-gray-600 mt-2">Manage your book collection</p>
        </div>
        <a href="{{ route('books.create') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition transform hover:scale-105 shadow-lg">
            <i class="fas fa-plus mr-2"></i>New Book
        </a>
    </div>

    <!-- Books Grid -->
    @if($books->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($books as $book)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-200 overflow-hidden border-t-4 border-green-500">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            <i class="fas fa-user text-green-500 mr-2"></i>{{ $book->author }}
                        </p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-calendar text-green-500 mr-2"></i>
                            <span>{{ $book->publication_year }}</span>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('books.show', $book) }}" class="flex-1 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition text-center text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('books.edit', $book) }}" class="flex-1 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition text-center text-sm font-medium">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition text-sm font-medium">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="bg-white rounded-xl shadow-lg p-4">
            {{ $books->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-book text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Books Yet</h3>
            <p class="text-gray-500 mb-6">Start building your collection</p>
            <a href="{{ route('books.create') }}" class="inline-block bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>Add Book
            </a>
        </div>
    @endif
</div>
@endsection
