@extends('layouts.app')

@section('title', 'Comments - ' . $task->title)

@section('content')
<div class="mb-6">
    <a href="{{ route('projects.tasks.index', $task->project) }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Tasks
    </a>
</div>

<div class="mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Comments</h1>
            <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1">Task: <strong>{{ $task->title }}</strong></p>
        </div>
        <a href="{{ route('tasks.comments.create', $task) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Comment
        </a>
    </div>
</div>

@if($comments->isEmpty())
    <div class="bg-white dark:bg-[#161615] rounded-xl border-2 border-dashed border-[#e3e3e0] dark:border-[#3E3E3A] p-12 text-center">
        <svg class="w-16 h-16 mx-auto text-[#706f6c] dark:text-[#A1A09A] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No comments yet</h3>
        <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">Be the first to comment on this task</p>
        <a href="{{ route('tasks.comments.create', $task) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Comment
        </a>
    </div>
@else
    <div class="space-y-4">
        @foreach($comments as $comment)
            <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm hover:shadow-md transition-all duration-200">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr($comment->author, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $comment->author }}</p>
                                <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ $comment->created_at->format('F j, Y g:i A') }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('tasks.comments.edit', [$task, $comment]) }}" class="p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('tasks.comments.destroy', [$task, $comment]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <p class="text-[#1b1b18] dark:text-[#EDEDEC] leading-relaxed whitespace-pre-wrap">{{ $comment->comment_text }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
