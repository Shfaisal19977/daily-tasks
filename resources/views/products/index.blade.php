@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Products</h1>
            <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1">Manage your product inventory</p>
        </div>
        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add New Product
        </a>
    </div>
</div>

@if($products->isEmpty())
    <div class="bg-white dark:bg-[#161615] rounded-xl border-2 border-dashed border-[#e3e3e0] dark:border-[#3E3E3A] p-12 text-center">
        <svg class="w-16 h-16 mx-auto text-[#706f6c] dark:text-[#A1A09A] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
        </svg>
        <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No products found</h3>
        <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">Start building your inventory</p>
        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add First Product
        </a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm hover:shadow-lg transition-all duration-200 overflow-hidden group">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-1 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->quantity < 10 ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' : 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' }}">
                                {{ $product->quantity }} in stock
                            </span>
                        </div>
                    </div>
                    
                    @if($product->description)
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4 line-clamp-2">{{ $product->description }}</p>
                    @endif

                    <div class="flex gap-2 pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <a href="{{ route('products.show', $product) }}" class="flex-1 text-center px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors font-medium text-sm">
                            View
                        </a>
                        <a href="{{ route('products.edit', $product) }}" class="flex-1 text-center px-4 py-2 bg-gray-50 dark:bg-gray-900/20 text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900/40 transition-colors font-medium text-sm">
                            Edit
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors font-medium text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
