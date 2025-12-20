@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Product Header -->
    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-orange-500">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                @if($product->description)
                    <p class="text-gray-600 mb-6">{{ $product->description }}</p>
                @endif
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-orange-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">Price</p>
                        <p class="text-2xl font-bold text-orange-600">${{ number_format($product->price, 2) }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">Stock Quantity</p>
                        <p class="text-2xl font-bold {{ $product->quantity < 10 ? 'text-red-600' : 'text-blue-600' }}">{{ $product->quantity }}</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg col-span-2">
                        <p class="text-sm text-gray-500 mb-1">Total Inventory Value</p>
                        <p class="text-2xl font-bold text-green-600">${{ number_format($product->price * $product->quantity, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <a href="{{ route('products.edit', $product) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition w-full">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Reduce Stock Form -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-minus-circle text-orange-600 mr-2"></i>Reduce Stock
        </h2>
        <form action="{{ route('products.reduce-stock', $product) }}" method="POST" class="flex gap-4">
            @csrf
            <input type="number" name="amount" min="1" max="{{ $product->quantity }}" value="1" required
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                <i class="fas fa-minus mr-2"></i>Reduce Stock
            </button>
        </form>
    </div>
</div>
@endsection
