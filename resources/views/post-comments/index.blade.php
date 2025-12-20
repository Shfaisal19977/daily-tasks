@extends('layouts.app')

@section('title', 'Comments - ' . $post->title)

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6 border-l-4 border-indigo-500">
        <div>
            <div class="flex items-center mb-2">
                <a href="{{ route('posts.show', $post) }}" class="text-indigo-600 hover:text-indigo-700 mr-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-comments text-indigo-600 mr-3"></i>Comments
                </h1>
            </div>
            <p class="text-gray-600">Post: <span class="font-semibold">{{ $post->title }}</span></p>
        </div>
        <a href="{{ route('posts.comments.create', $post) }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition transform hover:scale-105 shadow-lg">
            <i class="fas fa-plus mr-2"></i>New Comment
        </a>
    </div>

    <!-- Comments List -->
    @if($comments->count() > 0)
        <div class="space-y-4">
            @foreach($comments as $comment)
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-200 border-l-4 border-indigo-500">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="text-gray-800 mb-3 whitespace-pre-wrap">{{ $comment->content }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-user mr-2 text-indigo-500"></i>
                                <span class="font-medium">{{ $comment->user->name }}</span>
                                <span class="mx-2">•</span>
                                <i class="fas fa-envelope mr-2 text-indigo-500"></i>
                                <span>{{ $comment->user->email }}</span>
                                <span class="mx-2">•</span>
                                <i class="fas fa-clock mr-2 text-indigo-500"></i>
                                <span>{{ $comment->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                        </div>
                        <div class="flex space-x-2 ml-4">
                            <a href="{{ route('posts.comments.show', [$post, $comment]) }}" class="bg-indigo-500 text-white px-3 py-2 rounded-lg hover:bg-indigo-600 transition text-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('posts.comments.edit', [$post, $comment]) }}" class="bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600 transition text-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition text-sm">
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
            {{ $comments->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-comments text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Comments Yet</h3>
            <p class="text-gray-500 mb-6">Be the first to add a comment</p>
            <a href="{{ route('posts.comments.create', $post) }}" class="inline-block bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>Add Comment
            </a>
        </div>
    @endif
</div>
@endsection
