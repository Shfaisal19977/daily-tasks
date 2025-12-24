@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6 border-l-4" style="border-color: #456882;">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-newspaper mr-3" style="color: #456882;"></i>Posts
            </h1>
            <p class="text-gray-600 mt-2">Manage your blog posts</p>
        </div>
        <a href="{{ route('posts.create') }}" class="text-white px-6 py-3 rounded-lg transition transform hover:scale-105 shadow-lg" style="background: linear-gradient(to right, #234C6A, #456882);" onmouseover="this.style.background='linear-gradient(to right, #456882, #234C6A)'" onmouseout="this.style.background='linear-gradient(to right, #234C6A, #456882)'">
            <i class="fas fa-plus mr-2"></i>New Post
        </a>
    </div>

    <!-- Posts Grid -->
    @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-200 overflow-hidden border-t-4" style="border-color: #456882;">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">{{ $post->title }}</h3>
                        @if($post->excerpt)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                        @else
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($post->content, 100) }}</p>
                        @endif
                        
                        <!-- Author -->
                        <div class="flex items-center mb-3">
                            <i class="fas fa-user text-gray-400 mr-2"></i>
                            <span class="text-sm text-gray-600">{{ $post->user->name }}</span>
                        </div>

                        <!-- Categories -->
                        @if($post->categories->count() > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($post->categories->take(3) as $category)
                                    <span class="text-white text-xs px-2 py-1 rounded-full" style="background-color: #456882;">
                                        <i class="fas fa-tag mr-1"></i>{{ $category->name }}
                                    </span>
                                @endforeach
                                @if($post->categories->count() > 3)
                                    <span class="text-xs text-gray-500">+{{ $post->categories->count() - 3 }} more</span>
                                @endif
                            </div>
                        @endif

                        <!-- Published Status -->
                        @if($post->published_at)
                            <div class="text-xs text-gray-500 mb-4">
                                <i class="fas fa-calendar mr-1"></i>Published: {{ $post->published_at->format('M d, Y') }}
                            </div>
                        @else
                            <div class="text-xs text-yellow-600 mb-4">
                                <i class="fas fa-clock mr-1"></i>Draft
                            </div>
                        @endif

                        <div class="flex space-x-2">
                            <a href="{{ route('posts.show', $post) }}" class="flex-1 text-white px-4 py-2 rounded-lg transition text-center text-sm font-medium" style="background-color: #456882;" onmouseover="this.style.backgroundColor='#234C6A'" onmouseout="this.style.backgroundColor='#456882'">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('posts.edit', $post) }}" class="flex-1 text-white px-4 py-2 rounded-lg transition text-center text-sm font-medium" style="background-color: #234C6A;" onmouseover="this.style.backgroundColor='#456882'" onmouseout="this.style.backgroundColor='#234C6A'">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
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
            {{ $posts->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Posts Yet</h3>
            <p class="text-gray-500 mb-6">Start writing your first post</p>
            <a href="{{ route('posts.create') }}" class="inline-block text-white px-6 py-3 rounded-lg transition transform hover:scale-105" style="background: linear-gradient(to right, #234C6A, #456882);" onmouseover="this.style.background='linear-gradient(to right, #456882, #234C6A)'" onmouseout="this.style.background='linear-gradient(to right, #234C6A, #456882)'">
                <i class="fas fa-plus mr-2"></i>Add Post
            </a>
        </div>
    @endif
</div>
@endsection
