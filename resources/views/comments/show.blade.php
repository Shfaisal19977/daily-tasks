@extends('layouts.app')

@section('title', 'Comment by ' . $comment->author)

@section('content')
<div class="mb-6">
    <a href="{{ route('tasks.comments.index', $task) }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Comments
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 px-8 py-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-xl">
                                {{ strtoupper(substr($comment->author, 0, 1)) }}
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-white">{{ $comment->author }}</h1>
                                <p class="text-green-100 text-sm">{{ $comment->created_at->format('F j, Y g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('tasks.comments.edit', [$task, $comment]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('tasks.comments.destroy', [$task, $comment]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this comment?');">
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
                <div class="space-y-6">
                    <div>
                        <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-2 uppercase tracking-wide">Comment</h3>
                        <p class="text-lg text-[#1b1b18] dark:text-[#EDEDEC] leading-relaxed whitespace-pre-wrap">{{ $comment->comment_text }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <div class="p-4 bg-gray-50 dark:bg-[#0a0a0a] rounded-lg">
                            <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">Created</h3>
                            <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $comment->created_at->format('F j, Y g:i A') }}</p>
                        </div>
                        @if($comment->updated_at != $comment->created_at)
                            <div class="p-4 bg-gray-50 dark:bg-[#0a0a0a] rounded-lg">
                                <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">Last Updated</h3>
                                <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $comment->updated_at->format('F j, Y g:i A') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm p-6">
            <h2 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Task Info
            </h2>
            <div class="space-y-3">
                <div class="p-4 bg-gray-50 dark:bg-[#0a0a0a] rounded-lg">
                    <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">Task</h3>
                    <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $task->title }}</p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-[#0a0a0a] rounded-lg">
                    <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">Project</h3>
                    <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $task->project->name }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm p-6">
            <h2 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Quick Actions
            </h2>
            <div class="space-y-3">
                <a href="{{ route('tasks.comments.index', $task) }}" class="block w-full text-center px-4 py-3 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/40 transition-colors font-medium">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    View All Comments
                </a>
                <a href="{{ route('projects.tasks.show', [$task->project, $task]) }}" class="block w-full text-center px-4 py-3 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors font-medium">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    View Task
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

