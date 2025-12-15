@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center gap-2 mb-1">
            <a href="{{ route('projects.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Projects</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('projects.tasks.index', $task->project) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">{{ $task->project->name }}</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('tasks.comments.index', $task) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">{{ $task->title }}</a>
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Edit Comment</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update comment information</p>
    </div>

    <x-bladewind::card>
        <form action="{{ route('tasks.comments.update', [$task, $comment]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <x-bladewind::input label="Author" name="author" value="{{ old('author', $comment->author) }}" required="true" placeholder="Enter your name" />
                @error('author')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <x-bladewind::textarea label="Comment" name="comment_text" required="true" placeholder="Enter your comment">{{ old('comment_text', $comment->comment_text) }}</x-bladewind::textarea>
                @error('comment_text')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>

            @include('partials.form-actions', ['cancelUrl' => route('tasks.comments.index', $task), 'submitText' => 'Update Comment'])
        </form>
    </x-bladewind::card>
</div>
@endsection

