@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Post Header -->
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-green-500">
        <div class="flex justify-between items-start mb-6">
            <div class="flex-1">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
                
                <!-- Author and Date -->
                <div class="flex items-center space-x-4 mb-4">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-user mr-2"></i>
                        <span>{{ $post->user->name }}</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>Created: {{ $post->created_at->format('M d, Y') }}</span>
                    </div>
                    @if($post->published_at)
                        <div class="flex items-center text-green-600">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>Published: {{ $post->published_at->format('M d, Y') }}</span>
                        </div>
                    @else
                        <div class="flex items-center text-yellow-600">
                            <i class="fas fa-clock mr-2"></i>
                            <span>Draft</span>
                        </div>
                    @endif
                </div>

                <!-- Categories -->
                @if($post->categories->count() > 0)
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($post->categories as $category)
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-tag mr-1"></i>{{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Excerpt -->
                @if($post->excerpt)
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6">
                        <p class="text-gray-700 italic">{{ $post->excerpt }}</p>
                    </div>
                @endif
            </div>
            <div class="flex flex-col space-y-2 ml-4">
                <a href="{{ route('posts.edit', $post) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition w-full">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Post Content -->
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="prose max-w-none">
            <div class="text-gray-700 whitespace-pre-wrap">{{ $post->content }}</div>
        </div>
    </div>
</div>
@endsection
