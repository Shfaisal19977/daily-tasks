@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Projects</h1>
            <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1">Manage your projects and tasks</p>
        </div>
        <a href="{{ route('projects.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add New Project
        </a>
    </div>
</div>

@if($projects->isEmpty())
    <div class="bg-white dark:bg-[#161615] rounded-xl border-2 border-dashed border-[#e3e3e0] dark:border-[#3E3E3A] p-12 text-center">
        <svg class="w-16 h-16 mx-auto text-[#706f6c] dark:text-[#A1A09A] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
        </svg>
        <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No projects found</h3>
        <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">Create your first project to get started</p>
        <a href="{{ route('projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Project
        </a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
            <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm hover:shadow-lg transition-all duration-200 overflow-hidden group">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">
                                <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                            </h3>
                            @if($project->status)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                    {{ $project->status }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    @if($project->description)
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4 line-clamp-2">{{ $project->description }}</p>
                    @endif

                    <div class="flex items-center gap-4 mb-4 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span>{{ $project->tasks->count() }} tasks</span>
                        </div>
                    </div>

                    <div class="flex gap-2 pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <a href="{{ route('projects.show', $project) }}" class="flex-1 text-center px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors font-medium text-sm">
                            View
                        </a>
                        <a href="{{ route('projects.edit', $project) }}" class="flex-1 text-center px-4 py-2 bg-gray-50 dark:bg-gray-900/20 text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900/40 transition-colors font-medium text-sm">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
