@extends('layouts.app')

@section('title', 'Tasks - ' . $project->name)

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6 border-l-4 border-indigo-500">
        <div>
            <div class="flex items-center mb-2">
                <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:text-indigo-700 mr-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-tasks text-indigo-600 mr-3"></i>Tasks
                </h1>
            </div>
            <p class="text-gray-600">Project: <span class="font-semibold">{{ $project->name }}</span></p>
        </div>
        <a href="{{ route('projects.tasks.create', $project) }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition transform hover:scale-105 shadow-lg">
            <i class="fas fa-plus mr-2"></i>New Task
        </a>
    </div>

    <!-- Tasks List -->
    @if($tasks->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tasks as $task)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-200 overflow-hidden border-t-4 border-indigo-500">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-800 line-clamp-1">{{ $task->title }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $task->details }}</p>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if($task->status === 'completed') bg-green-100 text-green-800
                                    @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                                    @elseif($task->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if($task->priority === 'high') bg-red-100 text-red-800
                                    @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </div>
                            @if($task->due_date)
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-calendar mr-2 text-indigo-500"></i>
                                    <span>Due: {{ $task->due_date->format('M d, Y') }}</span>
                                </div>
                            @endif
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-comments mr-2 text-indigo-500"></i>
                                <span>{{ $task->comments->count() }} comments</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="flex-1 bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition text-center text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="flex-1 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition text-center text-sm font-medium">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition text-sm font-medium">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="bg-white rounded-xl shadow-lg p-4">
            {{ $tasks->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-tasks text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Tasks Yet</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first task</p>
            <a href="{{ route('projects.tasks.create', $project) }}" class="inline-block bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>Create Task
            </a>
        </div>
    @endif
</div>
@endsection
