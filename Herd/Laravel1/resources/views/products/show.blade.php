@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $product->name }}</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Product details</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('products.edit', $product) }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit
            </a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <x-bladewind::card>
        <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $product->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Price</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">${{ number_format($product->price, 2) }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Quantity</dt>
                <dd class="mt-1">
                    <span class="px-2 py-1 text-sm font-medium rounded-full {{ $product->quantity < 10 ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' : 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' }}">
                        {{ $product->quantity }}
                    </span>
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Value</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">${{ number_format($product->price * $product->quantity, 2) }}</dd>
            </div>
            @if($product->description)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $product->description }}</dd>
                </div>
            @endif
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $product->created_at->format('M d, Y') }}</dd>
            </div>
        </dl>
    </x-bladewind::card>

    <div class="mt-6">
        <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Products
        </a>
    </div>
</div>
@endsection

