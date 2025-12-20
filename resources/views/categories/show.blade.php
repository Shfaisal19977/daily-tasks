@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Category Header -->
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-pink-500">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $category->name }}</h1>
                @if($category->description)
                    <p class="text-gray-600 mb-6">{{ $category->description }}</p>
                @endif
                <div class="bg-pink-50 p-6 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Price</p>
                    <p class="text-3xl font-bold text-pink-600">${{ number_format($category->price, 2) }}</p>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <a href="{{ route('categories.edit', $category) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition w-full">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
