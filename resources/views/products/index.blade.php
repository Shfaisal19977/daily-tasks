@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6 border-l-4" style="border-color: #456882;">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-box mr-3" style="color: #456882;"></i>Products
            </h1>
            <p class="text-gray-600 mt-2">Manage your product inventory</p>
        </div>
        <a href="{{ route('products.create') }}" class="text-white px-6 py-3 rounded-lg transition transform hover:scale-105 shadow-lg" style="background: linear-gradient(to right, #1B3C53, #456882);" onmouseover="this.style.background='linear-gradient(to right, #234C6A, #1B3C53)'" onmouseout="this.style.background='linear-gradient(to right, #1B3C53, #456882)'">
            <i class="fas fa-plus mr-2"></i>New Product
        </a>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-200 overflow-hidden border-t-4" style="border-color: {{ $product->quantity < 10 ? '#dc2626' : '#456882' }};">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-800 line-clamp-1">{{ $product->name }}</h3>
                            @if($product->quantity < 10)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Low Stock
                                </span>
                            @endif
                        </div>
                        @if($product->description)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                        @endif
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Price</span>
                                <span class="font-bold" style="color: #456882;">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Stock</span>
                                <span class="font-bold {{ $product->quantity < 10 ? 'text-red-600' : 'text-gray-800' }}">{{ $product->quantity }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Total Value</span>
                                <span class="font-bold" style="color: #234C6A;">${{ number_format($product->price * $product->quantity, 2) }}</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $product) }}" class="flex-1 text-white px-4 py-2 rounded-lg transition text-center text-sm font-medium" style="background-color: #456882;" onmouseover="this.style.backgroundColor='#234C6A'" onmouseout="this.style.backgroundColor='#456882'">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('products.edit', $product) }}" class="flex-1 text-white px-4 py-2 rounded-lg transition text-center text-sm font-medium" style="background-color: #234C6A;" onmouseover="this.style.backgroundColor='#456882'" onmouseout="this.style.backgroundColor='#234C6A'">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
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
            {{ $products->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-box text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Products Yet</h3>
            <p class="text-gray-500 mb-6">Start building your inventory</p>
            <a href="{{ route('products.create') }}" class="inline-block text-white px-6 py-3 rounded-lg transition transform hover:scale-105" style="background: linear-gradient(to right, #1B3C53, #456882);" onmouseover="this.style.background='linear-gradient(to right, #234C6A, #1B3C53)'" onmouseout="this.style.background='linear-gradient(to right, #1B3C53, #456882)'">
                <i class="fas fa-plus mr-2"></i>Add Product
            </a>
        </div>
    @endif
</div>
@endsection
