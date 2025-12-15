@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Products
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 px-8 py-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $product->name }}</h1>
                        <p class="text-3xl font-bold text-purple-100">${{ number_format($product->price, 2) }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-white rounded-lg transition-colors backdrop-blur-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <div class="space-y-6">
                    <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-[#0a0a0a] rounded-lg">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 rounded-lg {{ $product->quantity < 10 ? 'bg-red-100 dark:bg-red-900' : 'bg-green-100 dark:bg-green-900' }} flex items-center justify-center">
                                <svg class="w-8 h-8 {{ $product->quantity < 10 ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">Quantity in Stock</h3>
                            <p class="text-3xl font-bold {{ $product->quantity < 10 ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">
                                {{ $product->quantity }}
                            </p>
                            @if($product->quantity < 10)
                                <p class="text-xs text-red-600 dark:text-red-400 mt-1">Low stock warning</p>
                            @endif
                        </div>
                    </div>

                    @if($product->description)
                        <div>
                            <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-2 uppercase tracking-wide">Description</h3>
                            <p class="text-lg text-[#1b1b18] dark:text-[#EDEDEC] leading-relaxed">{{ $product->description }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <div>
                            <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">Created At</h3>
                            <p class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">{{ $product->created_at->format('F j, Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] mb-1 uppercase tracking-wide">Updated At</h3>
                            <p class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">{{ $product->updated_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="bg-white dark:bg-[#161615] rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm p-6 sticky top-20">
            <h2 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Reduce Stock
            </h2>
            <form action="{{ route('products.reduce-stock', $product) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="amount" class="block text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                        Amount to Reduce
                    </label>
                    <input type="number" name="amount" id="amount" required min="1" max="{{ $product->quantity }}" 
                        class="w-full px-4 py-3 border-2 border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                        placeholder="Enter amount">
                    <p class="mt-2 text-xs text-[#706f6c] dark:text-[#A1A09A]">Available: {{ $product->quantity }} units</p>
                </div>
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Reduce Stock
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
