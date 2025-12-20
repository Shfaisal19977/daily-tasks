@extends('layouts.app')

@section('title', 'Comment Details')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Comment Header -->
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-indigo-500">
        <div class="mb-4">
            <a href="{{ route('posts.comments.index', $post) }}" class="text-indigo-600 hover:text-indigo-700 mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Back to Comments
            </a>
        </div>
        <div class="flex justify-between items-start">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Comment Details</h1>
                <p class="text-gray-600 mb-2">Post: <span class="font-semibold">{{ $post->title }}</span></p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('posts.comments.edit', [$post, $comment]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Comment Content -->
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Comment</h2>
            <p class="text-gray-700 whitespace-pre-wrap">{{ $comment->content }}</p>
        </div>

        <div class="border-t pt-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Details</h3>
            <div class="space-y-3">
                <div class="flex items-center">
                    <i class="fas fa-user text-indigo-500 mr-3 w-5"></i>
                    <span class="text-gray-600">User:</span>
                    <span class="font-semibold text-gray-800 ml-2">{{ $comment->user->name }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-envelope text-indigo-500 mr-3 w-5"></i>
                    <span class="text-gray-600">Email:</span>
                    <span class="font-semibold text-gray-800 ml-2">{{ $comment->user->email }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar text-indigo-500 mr-3 w-5"></i>
                    <span class="text-gray-600">Created:</span>
                    <span class="font-semibold text-gray-800 ml-2">{{ $comment->created_at->format('M d, Y h:i A') }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock text-indigo-500 mr-3 w-5"></i>
                    <span class="text-gray-600">Updated:</span>
                    <span class="font-semibold text-gray-800 ml-2">{{ $comment->updated_at->format('M d, Y h:i A') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
