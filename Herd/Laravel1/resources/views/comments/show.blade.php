@extends('layouts.app')

@section('title', 'Comment Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('projects.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Projects</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <a href="{{ route('projects.tasks.index', $task->project) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">{{ $task->project->name }}</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <a href="{{ route('tasks.comments.index', $task) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">{{ $task->title }}</a>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Comment Details</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">View comment information</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('tasks.comments.edit', [$task, $comment]) }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Edit
            </a>
            <form action="{{ route('tasks.comments.destroy', [$task, $comment]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <x-bladewind::card>
        <dl class="grid grid-cols-1 gap-6">
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Author</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $comment->author }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Comment</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 whitespace-pre-wrap">{{ $comment->comment_text }}</dd>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $comment->created_at->format('M d, Y h:i A') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated At</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $comment->updated_at->format('M d, Y h:i A') }}</dd>
                </div>
            </div>
        </dl>
    </x-bladewind::card>

    <div class="mt-6">
        <a href="{{ route('tasks.comments.index', $task) }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Comments
        </a>
    </div>
</div>
@endsection

