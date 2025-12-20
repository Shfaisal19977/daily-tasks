@extends('layouts.app')

@section('title', 'Comment Details')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Comment Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-teal-500">
        <div class="flex items-center mb-4">
            <a href="{{ route('tasks.comments.index', $task) }}" class="text-teal-600 hover:text-teal-700 mr-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Comment Details</h1>
        </div>
        <div class="flex justify-between items-start">
            <div class="flex-1">
                <p class="text-gray-800 text-lg mb-4">{{ $comment->comment_text }}</p>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-user mr-2 text-teal-500"></i>
                    <span class="font-medium">{{ $comment->author }}</span>
                    <span class="mx-2">•</span>
                    <i class="fas fa-clock mr-2 text-teal-500"></i>
                    <span>{{ $comment->created_at->format('F d, Y h:i A') }}</span>
                </div>
            </div>
            <div class="flex space-x-2 ml-4">
                <a href="{{ route('tasks.comments.edit', [$task, $comment]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('tasks.comments.destroy', [$task, $comment]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Task Info -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-tasks text-teal-600 mr-2"></i>Related Task
        </h2>
        <p class="text-gray-800 font-medium mb-2">{{ $task->title }}</p>
        <p class="text-sm text-gray-600">{{ $task->details }}</p>
        <a href="{{ route('projects.tasks.show', [$task->project, $task]) }}" class="inline-block mt-4 text-teal-600 hover:text-teal-700 font-medium">
            View Task <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>
@endsection
