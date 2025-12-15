@extends('layouts.app')

@section('title', $project->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $project->name }}</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Project details</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('projects.tasks.index', $project) }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                View Tasks
            </a>
            <a href="{{ route('projects.edit', $project) }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Edit
            </a>
            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
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
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $project->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                <dd class="mt-1">
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                        {{ ucfirst($project->status ?? 'N/A') }}
                    </span>
                </dd>
            </div>
            @if($project->start_date)
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Start Date</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $project->start_date->format('M d, Y') }}</dd>
                </div>
            @endif
            @if($project->end_date)
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">End Date</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $project->end_date->format('M d, Y') }}</dd>
                </div>
            @endif
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tasks</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $project->tasks->count() }} tasks</dd>
            </div>
            @if($project->description)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $project->description }}</dd>
                </div>
            @endif
        </dl>
    </x-bladewind::card>

    <div class="mt-6">
        <a href="{{ route('projects.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Projects
        </a>
    </div>
</div>
@endsection

