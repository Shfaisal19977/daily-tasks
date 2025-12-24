@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4" style="border-color: #456882;">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            <i class="fas fa-plus-circle mr-3" style="color: #456882;"></i>Create New Category
        </h1>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tag mr-2" style="color: #456882;"></i>Category Name
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg transition @error('name') border-red-500 @enderror" onfocus="this.style.borderColor='#456882'; this.style.boxShadow='0 0 0 3px rgba(69, 104, 130, 0.1)'" onblur="this.style.borderColor=''; this.style.boxShadow=''">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-dollar-sign mr-2" style="color: #456882;"></i>Price
                </label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg transition @error('price') border-red-500 @enderror" onfocus="this.style.borderColor='#456882'; this.style.boxShadow='0 0 0 3px rgba(69, 104, 130, 0.1)'" onblur="this.style.borderColor=''; this.style.boxShadow=''">
                @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-align-left mr-2" style="color: #456882;"></i>Description (Optional)
                </label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg transition @error('description') border-red-500 @enderror" onfocus="this.style.borderColor='#456882'; this.style.boxShadow='0 0 0 3px rgba(69, 104, 130, 0.1)'" onblur="this.style.borderColor=''; this.style.boxShadow=''">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 text-white px-6 py-3 rounded-lg transition transform hover:scale-105 font-medium" style="background: linear-gradient(to right, #456882, #234C6A);" onmouseover="this.style.background='linear-gradient(to right, #234C6A, #456882)'" onmouseout="this.style.background='linear-gradient(to right, #456882, #234C6A)'">
                    <i class="fas fa-save mr-2"></i>Create Category
                </button>
                <a href="{{ route('categories.index') }}" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition text-center font-medium">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
