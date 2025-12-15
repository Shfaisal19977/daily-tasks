<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Category',
    type: 'object',
    description: 'Category model with name, price, and description',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique category identifier', example: 1),
        new OA\Property(property: 'name', type: 'string', description: 'Category name', example: 'Electronics'),
        new OA\Property(property: 'price', type: 'string', format: 'decimal', description: 'Category price in decimal format', example: '99.99'),
        new OA\Property(property: 'description', type: 'string', nullable: true, description: 'Category description', example: 'Electronic products and accessories'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-12-01T15:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-12-01T15:00:00.000000Z'),
    ]
)]
class CategorySchema {}

#[OA\Schema(
    schema: 'StoreCategoryRequest',
    type: 'object',
    required: ['name', 'price'],
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, description: 'Category name', example: 'Electronics'),
        new OA\Property(property: 'price', type: 'number', format: 'float', minimum: 0, description: 'Category price (must be >= 0)', example: 99.99),
        new OA\Property(property: 'description', type: 'string', nullable: true, description: 'Optional category description', example: 'Electronic products and accessories'),
    ]
)]
class StoreCategoryRequestSchema {}

#[OA\Schema(
    schema: 'UpdateCategoryRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, description: 'Category name', example: 'Electronics Pro'),
        new OA\Property(property: 'price', type: 'number', format: 'float', minimum: 0, description: 'Category price (must be >= 0)', example: 149.99),
        new OA\Property(property: 'description', type: 'string', nullable: true, description: 'Category description', example: 'Premium electronic products'),
    ]
)]
class UpdateCategoryRequestSchema {}
