@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="mb-6">
    <a href="{{ route('projects.tasks.index', $project) }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Tasks
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 px-8 py-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $task->title }}</h1>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $task->status }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                {{ $task->priority }}
                            </span>
                            @if($task->due_date)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('M j, Y') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <div class="space-y-6">
                    @if($task->details)
                        <div>
                            <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-2 uppercase tracking-wide">Details</h3>
                            <p class="text-lg text-[#1b1b18] dark:text-[#EDEDEC] leading-relaxed whitespace-pre-wrap">{{ $task->details }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 bg-gray-50 dark:bg-[#0a0a0a] rounded-lg">
                            <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">Created</h3>
                            <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $task->created_at->format('F j, Y g:i A') }}</p>
                        </div>
                        @if($task->due_date)
                            <div class="p-4 bg-gray-50 dark:bg-[#0a0a0a] rounded-lg">
                                <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">Due Date</h3>
                                <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">{{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($task->comments->isNotEmpty())
            <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm">
                <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <h2 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Comments ({{ $task->comments->count() }})
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($task->comments as $comment)
                            <div class="bg-gray-50 dark:bg-[#0a0a0a] rounded-lg p-4">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-blue-600 flex items-center justify-center text-white font-semibold">
                                            {{ strtoupper(substr($comment->author, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $comment->author }}</p>
                                            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ $comment->created_at->format('F j, Y g:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('tasks.comments.edit', [$task, $comment]) }}" class="p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-800 rounded-lg transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <p class="text-[#1b1b18] dark:text-[#EDEDEC] leading-relaxed whitespace-pre-wrap">{{ $comment->comment_text }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="space-y-6">
        <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm p-6">
            <h2 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Quick Actions
            </h2>
            <div class="space-y-3">
                <a href="{{ route('tasks.comments.index', $task) }}" class="block w-full text-center px-4 py-3 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/40 transition-colors font-medium">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    View Comments
                </a>
                <a href="{{ route('tasks.comments.create', $task) }}" class="block w-full text-center px-4 py-3 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors font-medium">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Comment
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm p-6">
            <h2 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Task Info
            </h2>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Status</span>
                    <span class="text-sm font-bold text-blue-600 dark:text-blue-400 capitalize">{{ $task->status }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                    <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Priority</span>
                    <span class="text-sm font-bold text-purple-600 dark:text-purple-400 capitalize">{{ $task->priority }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Comments</span>
                    <span class="text-sm font-bold text-green-600 dark:text-green-400">{{ $task->comments->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

