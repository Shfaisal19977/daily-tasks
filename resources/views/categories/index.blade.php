@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Categories</h1>
            <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1">Organize your product categories</p>
        </div>
        <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add New Category
        </a>
    </div>
</div>

@if($categories->isEmpty())
    <div class="bg-white dark:bg-[#161615] rounded-xl border-2 border-dashed border-[#e3e3e0] dark:border-[#3E3E3A] p-12 text-center">
        <svg class="w-16 h-16 mx-auto text-[#706f6c] dark:text-[#A1A09A] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
        </svg>
        <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No categories found</h3>
        <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">Create your first category to get started</p>
        <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Category
        </a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm hover:shadow-lg transition-all duration-200 overflow-hidden group">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                            </h3>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">${{ number_format($category->price, 2) }}</p>
                        </div>
                    </div>
                    
                    @if($category->description)
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4 line-clamp-2">{{ $category->description }}</p>
                    @endif

                    <div class="flex gap-2 pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <a href="{{ route('categories.show', $category) }}" class="flex-1 text-center px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors font-medium text-sm">
                            View
                        </a>
                        <a href="{{ route('categories.edit', $category) }}" class="flex-1 text-center px-4 py-2 bg-gray-50 dark:bg-gray-900/20 text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900/40 transition-colors font-medium text-sm">
                            Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors font-medium text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
