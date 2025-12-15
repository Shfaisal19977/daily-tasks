<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReduceStockRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Products',
    description: 'Product management endpoints'
)]
class ProductController extends Controller
{
    #[OA\Get(
        path: '/api/products',
        summary: 'Get all products',
        tags: ['Products'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of products',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Product')
                )
            ),
        ]
    )]
    public function index(): JsonResponse|View
    {
        $products = Product::query()
            ->orderBy('created_at', 'desc')
            ->get();

        if ($this->wantsJson()) {
            return response()->json($products);
        }

        return view('products.index', compact('products'));
    }

    #[OA\Post(
        path: '/api/products',
        summary: 'Create a new product',
        description: 'Creates a new product with name, price, quantity, and optional description. All fields are validated before creation.',
        tags: ['Products'],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Product data',
            content: new OA\JsonContent(
                ref: '#/components/schemas/StoreProductRequest',
                example: [
                    'name' => 'Wireless Mouse',
                    'price' => 29.99,
                    'quantity' => 50,
                    'description' => 'Ergonomic wireless mouse with 2.4GHz connectivity',
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Product created successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Product',
                    example: [
                        'id' => 1,
                        'name' => 'Wireless Mouse',
                        'price' => '29.99',
                        'quantity' => 50,
                        'description' => 'Ergonomic wireless mouse with 2.4GHz connectivity',
                        'created_at' => '2025-11-30T18:00:00.000000Z',
                        'updated_at' => '2025-11-30T18:00:00.000000Z',
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'The name field is required.'),
                        new OA\Property(property: 'errors', type: 'object', example: ['name' => ['The name field is required.']]),
                    ]
                )
            ),
        ]
    )]
    public function create(): View
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request): JsonResponse|RedirectResponse
    {
        $product = Product::query()->create($request->validated());

        if ($this->wantsJson()) {
            return response()->json($product, 201);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    #[OA\Get(
        path: '/api/products/{product}',
        summary: 'Get a single product',
        description: 'Retrieves detailed information about a specific product by ID',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'product',
                in: 'path',
                required: true,
                description: 'Product ID',
                schema: new OA\Schema(type: 'integer'),
                example: 1
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Product details',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Product',
                    example: [
                        'id' => 1,
                        'name' => 'Wireless Mouse',
                        'price' => '29.99',
                        'quantity' => 50,
                        'description' => 'Ergonomic wireless mouse with 2.4GHz connectivity',
                        'created_at' => '2025-11-30T18:00:00.000000Z',
                        'updated_at' => '2025-11-30T18:00:00.000000Z',
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Product not found',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\\Models\\Product] 999'),
                    ]
                )
            ),
        ]
    )]
    public function show(Product $product): JsonResponse|View
    {
        if ($this->wantsJson()) {
            return response()->json($product);
        }

        return view('products.show', compact('product'));
    }

    #[OA\Put(
        path: '/api/products/{product}',
        summary: 'Update a product',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'product',
                in: 'path',
                required: true,
                description: 'Product ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Product data to update',
            content: new OA\JsonContent(
                ref: '#/components/schemas/UpdateProductRequest',
                example: [
                    'name' => 'Wireless Mouse Pro',
                    'price' => 34.99,
                    'quantity' => 75,
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Product updated successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Product',
                    example: [
                        'id' => 1,
                        'name' => 'Wireless Mouse Pro',
                        'price' => '34.99',
                        'quantity' => 75,
                        'description' => 'Updated ergonomic wireless mouse',
                        'created_at' => '2025-11-30T18:00:00.000000Z',
                        'updated_at' => '2025-12-01T10:30:00.000000Z',
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Product not found',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\\Models\\Product] 999'),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'The price must be a number.'),
                        new OA\Property(property: 'errors', type: 'object', example: ['price' => ['The price must be a number.']]),
                    ]
                )
            ),
        ]
    )]
    #[OA\Patch(
        path: '/api/products/{product}',
        summary: 'Partially update a product',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'product',
                in: 'path',
                required: true,
                description: 'Product ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Product data to update',
            content: new OA\JsonContent(
                ref: '#/components/schemas/UpdateProductRequest',
                example: [
                    'name' => 'Wireless Mouse Pro',
                    'price' => 34.99,
                    'quantity' => 75,
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Product updated successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Product',
                    example: [
                        'id' => 1,
                        'name' => 'Wireless Mouse Pro',
                        'price' => '34.99',
                        'quantity' => 75,
                        'description' => 'Updated ergonomic wireless mouse',
                        'created_at' => '2025-11-30T18:00:00.000000Z',
                        'updated_at' => '2025-12-01T10:30:00.000000Z',
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Product not found',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\\Models\\Product] 999'),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'The price must be a number.'),
                        new OA\Property(property: 'errors', type: 'object', example: ['price' => ['The price must be a number.']]),
                    ]
                )
            ),
        ]
    )]
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse|RedirectResponse
    {
        $product->update($request->validated());

        if ($this->wantsJson()) {
            return response()->json($product);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    #[OA\Delete(
        path: '/api/products/{product}',
        summary: 'Delete a product',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'product',
                in: 'path',
                required: true,
                description: 'Product ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Product deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Product deleted successfully'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Product not found'),
        ]
    )]
    public function destroy(Product $product): JsonResponse|RedirectResponse
    {
        $product->delete();

        if ($this->wantsJson()) {
            return response()->json(['message' => 'Product deleted successfully'], 200);
        }

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    #[OA\Post(
        path: '/api/products/{product}/reduce-stock',
        summary: 'Reduce product stock',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'product',
                in: 'path',
                required: true,
                description: 'Product ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Stock reduction data',
            content: new OA\JsonContent(
                ref: '#/components/schemas/ReduceStockRequest',
                example: [
                    'amount' => 5,
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Stock reduced successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Product',
                    example: [
                        'id' => 1,
                        'name' => 'Wireless Mouse',
                        'price' => '29.99',
                        'quantity' => 45,
                        'description' => 'Ergonomic wireless mouse',
                        'created_at' => '2025-11-30T18:00:00.000000Z',
                        'updated_at' => '2025-12-01T11:00:00.000000Z',
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Insufficient stock or validation error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Insufficient stock. Available: 2'),
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Product not found',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\\Models\\Product] 999'),
                    ]
                )
            ),
        ]
    )]
    public function reduceStock(ReduceStockRequest $request, Product $product): JsonResponse|RedirectResponse
    {
        $amount = $request->validated()['amount'];

        if ($product->quantity < $amount) {
            if ($this->wantsJson()) {
                return response()->json([
                    'message' => 'Insufficient stock. Available: '.$product->quantity,
                ], 422);
            }

            return redirect()->back()->with('error', 'Insufficient stock. Available: '.$product->quantity);
        }

        $product->quantity -= $amount;
        $product->save();

        if ($this->wantsJson()) {
            return response()->json($product);
        }

        return redirect()->route('products.show', $product)->with('success', 'Stock reduced successfully.');
    }
}
