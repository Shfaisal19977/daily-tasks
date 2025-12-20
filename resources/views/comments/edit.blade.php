@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-teal-500">
        <div class="flex items-center mb-6">
            <a href="{{ route('tasks.comments.show', [$task, $comment]) }}" class="text-teal-600 hover:text-teal-700 mr-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-edit text-teal-600 mr-3"></i>Edit Comment
                </h1>
                <p class="text-gray-600 mt-1">Task: {{ $task->title }}</p>
            </div>
        </div>

        <form action="{{ route('tasks.comments.update', [$task, $comment]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Comment Text -->
            <div>
                <label for="comment_text" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-comment mr-2 text-teal-500"></i>Comment
                </label>
                <textarea name="comment_text" id="comment_text" rows="6" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition @error('comment_text') border-red-500 @enderror">{{ old('comment_text', $comment->comment_text) }}</textarea>
                @error('comment_text')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Author -->
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user mr-2 text-teal-500"></i>Author Name
                </label>
                <input type="text" name="author" id="author" value="{{ old('author', $comment->author) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition @error('author') border-red-500 @enderror">
                @error('author')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-3 rounded-lg hover:from-teal-600 hover:to-teal-700 transition transform hover:scale-105 font-medium">
                    <i class="fas fa-save mr-2"></i>Update Comment
                </button>
                <a href="{{ route('tasks.comments.show', [$task, $comment]) }}" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition text-center font-medium">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
