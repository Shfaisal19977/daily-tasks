@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('projects.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Projects</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <a href="{{ route('projects.tasks.index', $project) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">{{ $project->name }}</a>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $task->title }}</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Task details</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('tasks.comments.index', $task) }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Comments ({{ $task->comments->count() }})
            </a>
            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Edit
            </a>
            <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <x-bladewind::card>
        <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Title</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $task->title }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                <dd class="mt-1">
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                        {{ ucfirst($task->status ?? 'N/A') }}
                    </span>
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Priority</dt>
                <dd class="mt-1">
                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $task->priority === 'high' ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' : ($task->priority === 'medium' ? 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200') }}">
                        {{ ucfirst($task->priority ?? 'N/A') }}
                    </span>
                </dd>
            </div>
            @if($task->due_date)
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Due Date</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $task->due_date->format('M d, Y') }}</dd>
                </div>
            @endif
            @if($task->details)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Details</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $task->details }}</dd>
                </div>
            @endif
        </dl>
    </x-bladewind::card>

    <div class="mt-6">
        <a href="{{ route('projects.tasks.index', $project) }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Tasks
        </a>
    </div>
</div>
@endsection

