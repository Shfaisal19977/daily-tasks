@extends('layouts.app')

@section('title', $project->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Projects
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 dark:from-orange-600 dark:to-orange-700 px-8 py-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $project->name }}</h1>
                        @if($project->status)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                                {{ $project->status }}
                            </span>
                        @endif
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('projects.tasks.create', $project) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Task
                        </a>
                        <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors backdrop-blur-sm">
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
                    @if($project->description)
                        <div>
                            <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-2 uppercase tracking-wide">Description</h3>
                            <p class="text-lg text-[#1b1b18] dark:text-[#EDEDEC] leading-relaxed">{{ $project->description }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($project->start_date)
                            <div class="p-4 bg-gray-50 dark:bg-[#0a0a0a] rounded-lg">
                                <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">Start Date</h3>
                                <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">{{ \Carbon\Carbon::parse($project->start_date)->format('F j, Y') }}</p>
                            </div>
                        @endif
                        @if($project->end_date)
                            <div class="p-4 bg-gray-50 dark:bg-[#0a0a0a] rounded-lg">
                                <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">End Date</h3>
                                <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">{{ \Carbon\Carbon::parse($project->end_date)->format('F j, Y') }}</p>
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
                Quick Stats
            </h2>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Total Tasks</span>
                    <span class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $project->tasks->count() }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Total Comments</span>
                    <span class="text-lg font-bold text-green-600 dark:text-green-400">{{ $project->tasks->sum(fn($task) => $task->comments->count()) }}</span>
                </div>
            </div>
        </div>

        <a href="{{ route('projects.tasks.index', $project) }}" class="block w-full text-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 font-semibold">
            View All Tasks →
        </a>
    </div>
</div>

@if($project->tasks->isNotEmpty())
    <div class="mt-6 bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm">
        <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <h2 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Recent Tasks</h2>
        </div>
        <div class="p-6">
            <div class="space-y-3">
                @foreach($project->tasks->take(5) as $task)
                    <a href="{{ route('projects.tasks.index', $project) }}" class="block p-4 bg-gray-50 dark:bg-[#0a0a0a] rounded-lg hover:bg-gray-100 dark:hover:bg-[#161615] transition-colors group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC] group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $task->title }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs px-2 py-0.5 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">{{ $task->status }}</span>
                                    <span class="text-xs px-2 py-0.5 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200">{{ $task->priority }}</span>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-[#706f6c] dark:text-[#A1A09A] group-hover:text-blue-600 dark:group-hover:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
@endsection
