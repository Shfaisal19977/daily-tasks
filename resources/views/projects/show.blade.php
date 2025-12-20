@extends('layouts.app')

@section('title', $project->name)

@section('content')
<div class="space-y-6">
    <!-- Project Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $project->name }}</h1>
                <p class="text-gray-600">{{ $project->description }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('projects.edit', $project) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Project Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Info Card -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-purple-600 mr-2"></i>Project Details
            </h2>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        @if($project->status === 'completed') bg-green-100 text-green-800
                        @elseif($project->status === 'in_progress') bg-blue-100 text-blue-800
                        @elseif($project->status === 'planned') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Start Date</p>
                    <p class="font-medium text-gray-800">{{ $project->start_date ? $project->start_date->format('F d, Y') : 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">End Date</p>
                    <p class="font-medium text-gray-800">{{ $project->end_date ? $project->end_date->format('F d, Y') : 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Created</p>
                    <p class="font-medium text-gray-800">{{ $project->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Tasks Card -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-tasks text-purple-600 mr-2"></i>Tasks ({{ $project->tasks->count() }})
                </h2>
                <a href="{{ route('projects.tasks.create', $project) }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition text-sm">
                    <i class="fas fa-plus mr-1"></i>Add Task
                </a>
            </div>
            @if($project->tasks->count() > 0)
                <div class="space-y-2">
                    @foreach($project->tasks->take(5) as $task)
                        <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="block p-3 bg-gray-50 rounded-lg hover:bg-purple-50 transition">
                            <p class="font-medium text-gray-800">{{ $task->title }}</p>
                            <p class="text-sm text-gray-500">{{ $task->status }} • {{ $task->priority }}</p>
                        </a>
                    @endforeach
                    @if($project->tasks->count() > 5)
                        <a href="{{ route('projects.tasks.index', $project) }}" class="block text-center text-purple-600 hover:text-purple-700 font-medium py-2">
                            View all {{ $project->tasks->count() }} tasks →
                        </a>
                    @endif
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No tasks yet</p>
            @endif
        </div>
    </div>

    <!-- View All Tasks Button -->
    <div class="text-center">
        <a href="{{ route('projects.tasks.index', $project) }}" class="inline-block bg-gradient-to-r from-purple-500 to-purple-600 text-white px-8 py-3 rounded-lg hover:from-purple-600 hover:to-purple-700 transition transform hover:scale-105">
            <i class="fas fa-tasks mr-2"></i>View All Tasks
        </a>
    </div>
</div>
@endsection
