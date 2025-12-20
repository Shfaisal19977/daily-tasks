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
</div>
@endsection
