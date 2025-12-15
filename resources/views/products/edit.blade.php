@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="mb-6">
    <a href="{{ route('products.show', $product) }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Product
    </a>
</div>

<div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm">
    <div class="bg-gradient-to-r from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 px-8 py-6">
        <h1 class="text-3xl font-bold text-white">Edit Product</h1>
        <p class="text-purple-100 mt-1">Update product information</p>
    </div>

    <form action="{{ route('products.update', $product) }}" method="POST" class="p-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                    Product Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                    class="w-full px-4 py-3 border-2 border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                    placeholder="Enter product name">
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                    Price <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-[#706f6c] dark:text-[#A1A09A]">$</span>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required step="0.01" min="0"
                        class="w-full pl-8 pr-4 py-3 border-2 border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                        placeholder="0.00">
                </div>
                @error('price')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="quantity" class="block text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                    Quantity <span class="text-red-500">*</span>
                </label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" required min="0"
                    class="w-full px-4 py-3 border-2 border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                    placeholder="0">
                @error('quantity')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                    Description
                </label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-3 border-2 border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all resize-none"
                    placeholder="Enter product description (optional)">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="flex gap-4 pt-6 mt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
            <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Product
            </button>
            <a href="{{ route('products.show', $product) }}" class="px-6 py-3 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors font-semibold">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
