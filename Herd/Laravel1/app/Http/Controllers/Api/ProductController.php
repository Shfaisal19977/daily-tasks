<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReduceStockRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($products);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::query()->create($request->validated());

        return response()->json($product, 201);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());

        return response()->json($product);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function reduceStock(ReduceStockRequest $request, Product $product): JsonResponse
    {
        $amount = $request->validated()['amount'];

        if ($product->quantity < $amount) {
            return response()->json([
                'message' => 'Insufficient stock. Available: '.$product->quantity,
            ], 422);
        }

        $product->quantity -= $amount;
        $product->save();

        return response()->json($product);
    }
}
