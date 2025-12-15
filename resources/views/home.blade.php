@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium mb-1">Total Books</p>
                <p class="text-3xl font-bold">{{ $stats['books'] }}</p>
            </div>
            <div class="bg-white/20 rounded-lg p-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>
        <a href="{{ route('books.index') }}" class="text-blue-100 hover:text-white text-sm font-medium mt-4 inline-flex items-center">
            View all <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm font-medium mb-1">Categories</p>
                <p class="text-3xl font-bold">{{ $stats['categories'] }}</p>
            </div>
            <div class="bg-white/20 rounded-lg p-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
        </div>
        <a href="{{ route('categories.index') }}" class="text-green-100 hover:text-white text-sm font-medium mt-4 inline-flex items-center">
            View all <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm font-medium mb-1">Products</p>
                <p class="text-3xl font-bold">{{ $stats['products'] }}</p>
                @if($stats['low_stock_products'] > 0)
                    <p class="text-purple-100 text-xs mt-1">{{ $stats['low_stock_products'] }} low stock</p>
                @endif
            </div>
            <div class="bg-white/20 rounded-lg p-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="text-purple-100 hover:text-white text-sm font-medium mt-4 inline-flex items-center">
            View all <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>

    <div class="bg-gradient-to-br from-orange-500 to-orange-600 dark:from-orange-600 dark:to-orange-700 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-orange-100 text-sm font-medium mb-1">Projects</p>
                <p class="text-3xl font-bold">{{ $stats['projects'] }}</p>
                <p class="text-orange-100 text-xs mt-1">{{ $stats['tasks'] }} tasks</p>
            </div>
            <div class="bg-white/20 rounded-lg p-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
        </div>
        <a href="{{ route('projects.index') }}" class="text-orange-100 hover:text-white text-sm font-medium mt-4 inline-flex items-center">
            View all <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>
</div>

<!-- Quick Actions -->
<div class="mb-8">
    <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Quick Actions</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('books.create') }}" class="group bg-white dark:bg-[#161615] rounded-lg border-2 border-[#e3e3e0] dark:border-[#3E3E3A] p-5 hover:border-blue-500 dark:hover:border-blue-500 hover:shadow-lg transition-all">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-2 group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition-colors">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Add Book</p>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Create new book</p>
                </div>
            </div>
        </a>

        <a href="{{ route('products.create') }}" class="group bg-white dark:bg-[#161615] rounded-lg border-2 border-[#e3e3e0] dark:border-[#3E3E3A] p-5 hover:border-purple-500 dark:hover:border-purple-500 hover:shadow-lg transition-all">
            <div class="flex items-center gap-3">
                <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-2 group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Add Product</p>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Add to inventory</p>
                </div>
            </div>
        </a>

        <a href="{{ route('projects.create') }}" class="group bg-white dark:bg-[#161615] rounded-lg border-2 border-[#e3e3e0] dark:border-[#3E3E3A] p-5 hover:border-orange-500 dark:hover:border-orange-500 hover:shadow-lg transition-all">
            <div class="flex items-center gap-3">
                <div class="bg-orange-100 dark:bg-orange-900/30 rounded-lg p-2 group-hover:bg-orange-200 dark:group-hover:bg-orange-900/50 transition-colors">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">New Project</p>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Start a project</p>
                </div>
            </div>
        </a>

        <a href="{{ route('categories.create') }}" class="group bg-white dark:bg-[#161615] rounded-lg border-2 border-[#e3e3e0] dark:border-[#3E3E3A] p-5 hover:border-green-500 dark:hover:border-green-500 hover:shadow-lg transition-all">
            <div class="flex items-center gap-3">
                <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-2 group-hover:bg-green-200 dark:group-hover:bg-green-900/50 transition-colors">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">New Category</p>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Create category</p>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Books -->
    <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm">
        <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Recent Books</h3>
                <a href="{{ route('books.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all</a>
            </div>
        </div>
        <div class="p-6">
            @if($recentBooks->isEmpty())
                <p class="text-[#706f6c] dark:text-[#A1A09A] text-center py-4">No books yet</p>
            @else
                <div class="space-y-3">
                    @foreach($recentBooks as $book)
                        <a href="{{ route('books.show', $book) }}" class="block p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-[#0a0a0a] transition-colors group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-[#1b1b18] dark:text-[#EDEDEC] group-hover:text-blue-600 dark:group-hover:text-blue-400">{{ $book->title }}</p>
                                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">{{ $book->author }} • {{ $book->publication_year }}</p>
                                </div>
                                <svg class="w-5 h-5 text-[#706f6c] dark:text-[#A1A09A] group-hover:text-blue-600 dark:group-hover:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm">
        <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Recent Projects</h3>
                <a href="{{ route('projects.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all</a>
            </div>
        </div>
        <div class="p-6">
            @if($recentProjects->isEmpty())
                <p class="text-[#706f6c] dark:text-[#A1A09A] text-center py-4">No projects yet</p>
            @else
                <div class="space-y-3">
                    @foreach($recentProjects as $project)
                        <a href="{{ route('projects.show', $project) }}" class="block p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-[#0a0a0a] transition-colors group">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <p class="font-medium text-[#1b1b18] dark:text-[#EDEDEC] group-hover:text-blue-600 dark:group-hover:text-blue-400">{{ $project->name }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        @if($project->status)
                                            <span class="text-xs px-2 py-0.5 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">{{ $project->status }}</span>
                                        @endif
                                        <span class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ $project->tasks->count() }} tasks</span>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-[#706f6c] dark:text-[#A1A09A] group-hover:text-blue-600 dark:group-hover:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Inventory Value -->
@if($stats['total_inventory_value'] > 0)
<div class="mt-6 bg-gradient-to-r from-indigo-500 to-purple-600 dark:from-indigo-600 dark:to-purple-700 rounded-xl shadow-lg p-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-indigo-100 text-sm font-medium mb-1">Total Inventory Value</p>
            <p class="text-3xl font-bold">${{ number_format($stats['total_inventory_value'], 2) }}</p>
        </div>
        <div class="bg-white/20 rounded-lg p-3">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
    </div>
</div>
@endif
@endsection
