<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReduceStockRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

/**
 * @group Products
 */
class ProductController extends Controller
{
    /**
     * Get all products
     *
     * @response 200 [{"id": 1, "name": "Laptop Stand", "price": "49.99", "quantity": 100, "description": "Adjustable aluminum laptop stand", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}]
     */
    public function index(): JsonResponse
    {
        $products = Product::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($products);
    }

    /**
     * Create a new product
     *
     * @bodyParam name string required The product name. Example: Laptop Stand
     * @bodyParam price numeric required The product price. Example: 49.99
     * @bodyParam quantity integer required The product quantity. Example: 100
     * @bodyParam description string The product description. Example: Adjustable aluminum laptop stand
     *
     * @response 201 {"id": 1, "name": "Laptop Stand", "price": "49.99", "quantity": 100, "description": "Adjustable aluminum laptop stand", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 422 {"message": "The name field is required."}
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::query()->create($request->validated());

        return response()->json($product, 201);
    }

    /**
     * Get a single product
     *
     * @urlParam product integer required The ID of the product. Example: 1
     *
     * @response 200 {"id": 1, "name": "Laptop Stand", "price": "49.99", "quantity": 100, "description": "Adjustable aluminum laptop stand", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 404 {"message": "No query results for model [App\\Models\\Product] 1"}
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    /**
     * Update a product
     *
     * @urlParam product integer required The ID of the product. Example: 1
     *
     * @bodyParam name string The product name. Example: Laptop Stand
     * @bodyParam price numeric The product price. Example: 49.99
     * @bodyParam quantity integer The product quantity. Example: 100
     * @bodyParam description string The product description. Example: Adjustable aluminum laptop stand
     *
     * @response 200 {"id": 1, "name": "Laptop Stand", "price": "49.99", "quantity": 100, "description": "Adjustable aluminum laptop stand", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 404 {"message": "No query results for model [App\\Models\\Product] 1"}
     * @response 422 {"message": "The price must be a number."}
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());

        return response()->json($product);
    }

    /**
     * Delete a product
     *
     * @urlParam product integer required The ID of the product. Example: 1
     *
     * @response 200 {"message": "Product deleted successfully"}
     * @response 404 {"message": "No query results for model [App\\Models\\Product] 1"}
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    /**
     * Reduce product stock
     *
     * @urlParam product integer required The ID of the product. Example: 1
     *
     * @bodyParam amount integer required The amount to reduce from stock. Example: 5
     *
     * @response 200 {"id": 1, "name": "Laptop Stand", "price": "49.99", "quantity": 95, "description": "Adjustable aluminum laptop stand", "created_at": "2025-11-30T18:00:00.000000Z", "updated_at": "2025-11-30T18:00:00.000000Z"}
     * @response 422 {"message": "Insufficient stock. Available: 2"}
     * @response 404 {"message": "No query results for model [App\\Models\\Product] 1"}
     */
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
