@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="space-y-6">
    <!-- Task Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-indigo-500">
        <div class="flex justify-between items-start">
            <div>
                <div class="flex items-center mb-2">
                    <a href="{{ route('projects.tasks.index', $project) }}" class="text-indigo-600 hover:text-indigo-700 mr-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $task->title }}</h1>
                </div>
                <p class="text-gray-600">{{ $task->details }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Task Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Info Card -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-indigo-600 mr-2"></i>Task Details
            </h2>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        @if($task->status === 'completed') bg-green-100 text-green-800
                        @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Priority</p>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        @if($task->priority === 'high') bg-red-100 text-red-800
                        @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                        @else bg-green-100 text-green-800
                        @endif">
                        {{ ucfirst($task->priority) }}
                    </span>
                </div>
                @if($task->due_date)
                    <div>
                        <p class="text-sm text-gray-500">Due Date</p>
                        <p class="font-medium text-gray-800">{{ $task->due_date->format('F d, Y') }}</p>
                    </div>
                @endif
                <div>
                    <p class="text-sm text-gray-500">Created</p>
                    <p class="font-medium text-gray-800">{{ $task->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Comments Card -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-comments text-indigo-600 mr-2"></i>Comments ({{ $task->comments->count() }})
                </h2>
                <a href="{{ route('tasks.comments.create', $task) }}" class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition text-sm">
                    <i class="fas fa-plus mr-1"></i>Add Comment
                </a>
            </div>
            @if($task->comments->count() > 0)
                <div class="space-y-3">
                    @foreach($task->comments->take(5) as $comment)
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-800">{{ $comment->comment_text }}</p>
                            <p class="text-xs text-gray-500 mt-1">by {{ $comment->author }}</p>
                        </div>
                    @endforeach
                    @if($task->comments->count() > 5)
                        <a href="{{ route('tasks.comments.index', $task) }}" class="block text-center text-indigo-600 hover:text-indigo-700 font-medium py-2">
                            View all {{ $task->comments->count() }} comments →
                        </a>
                    @endif
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No comments yet</p>
            @endif
        </div>
    </div>

    <!-- View All Comments Button -->
    <div class="text-center">
        <a href="{{ route('tasks.comments.index', $task) }}" class="inline-block bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-8 py-3 rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition transform hover:scale-105">
            <i class="fas fa-comments mr-2"></i>View All Comments
        </a>
    </div>
</div>
@endsection
