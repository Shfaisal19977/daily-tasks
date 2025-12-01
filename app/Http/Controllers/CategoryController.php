<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Categories',
    description: 'Category management endpoints'
)]
class CategoryController extends Controller
{
    #[OA\Get(
        path: '/api/categories',
        summary: 'Get all categories',
        tags: ['Categories'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of categories',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Category')
                )
            ),
        ]
    )]
    public function index(): JsonResponse
    {
        $categories = Category::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($categories);
    }

    #[OA\Post(
        path: '/api/categories',
        summary: 'Create a new category',
        description: 'Creates a new category with name, price, and optional description. All fields are validated before creation.',
        tags: ['Categories'],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Category data',
            content: new OA\JsonContent(
                ref: '#/components/schemas/StoreCategoryRequest',
                example: [
                    'name' => 'Electronics',
                    'price' => 99.99,
                    'description' => 'Electronic products and accessories',
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Category created successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Category',
                    example: [
                        'id' => 1,
                        'name' => 'Electronics',
                        'price' => '99.99',
                        'description' => 'Electronic products and accessories',
                        'created_at' => '2025-12-01T15:00:00.000000Z',
                        'updated_at' => '2025-12-01T15:00:00.000000Z',
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
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::query()->create($request->validated());

        return response()->json($category, 201);
    }

    #[OA\Get(
        path: '/api/categories/{category}',
        summary: 'Get a single category',
        description: 'Retrieves detailed information about a specific category by ID',
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'category',
                in: 'path',
                required: true,
                description: 'Category ID',
                schema: new OA\Schema(type: 'integer'),
                example: 1
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Category details',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Category',
                    example: [
                        'id' => 1,
                        'name' => 'Electronics',
                        'price' => '99.99',
                        'description' => 'Electronic products and accessories',
                        'created_at' => '2025-12-01T15:00:00.000000Z',
                        'updated_at' => '2025-12-01T15:00:00.000000Z',
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Category not found',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\\Models\\Category] 999'),
                    ]
                )
            ),
        ]
    )]
    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    #[OA\Put(
        path: '/api/categories/{category}',
        summary: 'Update a category',
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'category',
                in: 'path',
                required: true,
                description: 'Category ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Category data to update',
            content: new OA\JsonContent(
                ref: '#/components/schemas/UpdateCategoryRequest',
                example: [
                    'name' => 'Electronics Pro',
                    'price' => 149.99,
                    'description' => 'Premium electronic products',
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Category updated successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Category',
                    example: [
                        'id' => 1,
                        'name' => 'Electronics Pro',
                        'price' => '149.99',
                        'description' => 'Premium electronic products',
                        'created_at' => '2025-12-01T15:00:00.000000Z',
                        'updated_at' => '2025-12-01T16:30:00.000000Z',
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Category not found',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\\Models\\Category] 999'),
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
        path: '/api/categories/{category}',
        summary: 'Partially update a category',
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'category',
                in: 'path',
                required: true,
                description: 'Category ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Category data to update',
            content: new OA\JsonContent(
                ref: '#/components/schemas/UpdateCategoryRequest',
                example: [
                    'name' => 'Electronics Pro',
                    'price' => 149.99,
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Category updated successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Category',
                    example: [
                        'id' => 1,
                        'name' => 'Electronics Pro',
                        'price' => '149.99',
                        'description' => 'Electronic products and accessories',
                        'created_at' => '2025-12-01T15:00:00.000000Z',
                        'updated_at' => '2025-12-01T16:30:00.000000Z',
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Category not found',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\\Models\\Category] 999'),
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
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $category->update($request->validated());

        return response()->json($category);
    }

    #[OA\Delete(
        path: '/api/categories/{category}',
        summary: 'Delete a category',
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'category',
                in: 'path',
                required: true,
                description: 'Category ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Category deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Category deleted successfully'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Category not found'),
        ]
    )]
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
