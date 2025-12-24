@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6 border-l-4" style="border-color: #456882;">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-tags mr-3" style="color: #456882;"></i>Categories
            </h1>
            <p class="text-gray-600 mt-2">Organize your products</p>
        </div>
        <a href="{{ route('categories.create') }}" class="text-white px-6 py-3 rounded-lg transition transform hover:scale-105 shadow-lg" style="background: linear-gradient(to right, #456882, #234C6A);" onmouseover="this.style.background='linear-gradient(to right, #234C6A, #456882)'" onmouseout="this.style.background='linear-gradient(to right, #456882, #234C6A)'">
            <i class="fas fa-plus mr-2"></i>New Category
        </a>
    </div>

    <!-- Categories Grid -->
    @if($categories->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-200 overflow-hidden border-t-4" style="border-color: #456882;">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $category->name }}</h3>
                        @if($category->description)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $category->description }}</p>
                        @endif
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">Price</span>
                            <span class="font-bold" style="color: #456882;">${{ number_format($category->price, 2) }}</span>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('categories.show', $category) }}" class="flex-1 text-white px-4 py-2 rounded-lg transition text-center text-sm font-medium" style="background-color: #456882;" onmouseover="this.style.backgroundColor='#234C6A'" onmouseout="this.style.backgroundColor='#456882'">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('categories.edit', $category) }}" class="flex-1 text-white px-4 py-2 rounded-lg transition text-center text-sm font-medium" style="background-color: #234C6A;" onmouseover="this.style.backgroundColor='#456882'" onmouseout="this.style.backgroundColor='#234C6A'">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
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
            {{ $categories->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-tags text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Categories Yet</h3>
            <p class="text-gray-500 mb-6">Start organizing your products</p>
            <a href="{{ route('categories.create') }}" class="inline-block text-white px-6 py-3 rounded-lg transition transform hover:scale-105" style="background: linear-gradient(to right, #456882, #234C6A);" onmouseover="this.style.background='linear-gradient(to right, #234C6A, #456882)'" onmouseout="this.style.background='linear-gradient(to right, #456882, #234C6A)'">
                <i class="fas fa-plus mr-2"></i>Add Category
            </a>
        </div>
    @endif
</div>
@endsection
