@extends('layouts.app')

@section('title', 'Create Comment')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-indigo-500">
        <div class="mb-6">
            <a href="{{ route('posts.comments.index', $post) }}" class="text-indigo-600 hover:text-indigo-700 mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Back to Comments
            </a>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-plus-circle text-indigo-600 mr-3"></i>Create New Comment
            </h1>
            <p class="text-gray-600 mt-2">Post: <span class="font-semibold">{{ $post->title }}</span></p>
        </div>

        <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="space-y-6">
            @csrf

            <!-- User -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user mr-2 text-indigo-500"></i>User
                </label>
                <select name="user_id" id="user_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('user_id') border-red-500 @enderror">
                    <option value="">Select a user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-comment mr-2 text-indigo-500"></i>Comment Content
                </label>
                <textarea name="content" id="content" rows="6" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition transform hover:scale-105 font-medium">
                    <i class="fas fa-save mr-2"></i>Create Comment
                </button>
                <a href="{{ route('posts.comments.index', $post) }}" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition text-center font-medium">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
