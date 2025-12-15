@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="mb-6">
    <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Books
    </a>
</div>

<div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm overflow-hidden">
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 px-8 py-6">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-white mb-2">{{ $book->title }}</h1>
                <p class="text-blue-100 text-lg">by {{ $book->author }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors backdrop-blur-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-white rounded-lg transition-colors backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-2 uppercase tracking-wide">Publication Year</h3>
                <p class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $book->publication_year }}</p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-2 uppercase tracking-wide">Created At</h3>
                <p class="text-lg text-[#1b1b18] dark:text-[#EDEDEC]">{{ $book->created_at->format('F j, Y g:i A') }}</p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-2 uppercase tracking-wide">Updated At</h3>
                <p class="text-lg text-[#1b1b18] dark:text-[#EDEDEC]">{{ $book->updated_at->format('F j, Y g:i A') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
