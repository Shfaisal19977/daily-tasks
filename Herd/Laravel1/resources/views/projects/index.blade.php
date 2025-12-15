@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Projects</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your projects</p>
        </div>
        <a href="{{ route('projects.create') }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Project
        </a>
    </div>

    @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
                <x-bladewind::card>
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $project->name }}</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $project->description ?? 'No description' }}</p>
                        </div>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Tasks:</span>
                            <span class="font-medium text-gray-900 dark:text-gray-100">{{ $project->tasks->count() }}</span>
                        </div>
                        @if($project->start_date)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Start:</span>
                                <span class="text-gray-900 dark:text-gray-100">{{ $project->start_date->format('M d, Y') }}</span>
                            </div>
                        @endif
                        @if($project->end_date)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">End:</span>
                                <span class="text-gray-900 dark:text-gray-100">{{ $project->end_date->format('M d, Y') }}</span>
                            </div>
                        @endif
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Status:</span>
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                {{ ucfirst($project->status ?? 'N/A') }}
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('projects.show', $project) }}" class="flex-1 text-center px-3 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition-colors">View</a>
                        <a href="{{ route('projects.tasks.index', $project) }}" class="flex-1 text-center px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">Tasks</a>
                        <a href="{{ route('projects.edit', $project) }}" class="flex-1 text-center px-3 py-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 transition-colors">Edit</a>
                    </div>
                </x-bladewind::card>
            @endforeach
        </div>
    @else
        <x-bladewind::empty-state title="No projects yet" description="Get started by creating your first project." action_label="Create Project" action_url="{{ route('projects.create') }}" />
    @endif
</div>
@endsection

