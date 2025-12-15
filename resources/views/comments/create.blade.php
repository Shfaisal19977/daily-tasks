@extends('layouts.app')

@section('title', 'Create Comment')

@section('content')
<div class="mb-6">
    <a href="{{ route('tasks.comments.index', $task) }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Comments
    </a>
</div>

<div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm">
    <div class="bg-gradient-to-r from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 px-8 py-6">
        <h1 class="text-3xl font-bold text-white">Create New Comment</h1>
        <p class="text-green-100 mt-1">Task: <strong>{{ $task->title }}</strong></p>
    </div>

    <form action="{{ route('tasks.comments.store', $task) }}" method="POST" class="p-8">
        @csrf

        <div class="space-y-6">
            <div>
                <label for="author" class="block text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                    Author <span class="text-red-500">*</span>
                </label>
                <input type="text" name="author" id="author" value="{{ old('author') }}" required
                    class="w-full px-4 py-3 border-2 border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all"
                    placeholder="Enter your name">
                @error('author')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="comment_text" class="block text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                    Comment <span class="text-red-500">*</span>
                </label>
                <textarea name="comment_text" id="comment_text" rows="6" required
                    class="w-full px-4 py-3 border-2 border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all resize-none"
                    placeholder="Enter your comment...">{{ old('comment_text') }}</textarea>
                @error('comment_text')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Create Comment
                </button>
                <a href="{{ route('tasks.comments.index', $task) }}" class="px-6 py-3 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors font-semibold">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
