<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Product',
    type: 'object',
    description: 'Product model with inventory information',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique product identifier', example: 1),
        new OA\Property(property: 'name', type: 'string', description: 'Product name', example: 'Laptop Stand'),
        new OA\Property(property: 'price', type: 'string', format: 'decimal', description: 'Product price in decimal format', example: '49.99'),
        new OA\Property(property: 'quantity', type: 'integer', description: 'Available stock quantity', example: 100),
        new OA\Property(property: 'description', type: 'string', nullable: true, description: 'Product description', example: 'Adjustable aluminum laptop stand with ergonomic design'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-11-30T18:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-11-30T18:00:00.000000Z'),
    ]
)]
class ProductSchema {}

#[OA\Schema(
    schema: 'StoreProductRequest',
    type: 'object',
    required: ['name', 'price', 'quantity'],
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, description: 'Product name', example: 'Wireless Mouse'),
        new OA\Property(property: 'price', type: 'number', format: 'float', minimum: 0, description: 'Product price (must be >= 0)', example: 29.99),
        new OA\Property(property: 'quantity', type: 'integer', minimum: 0, description: 'Initial stock quantity (must be >= 0)', example: 50),
        new OA\Property(property: 'description', type: 'string', nullable: true, description: 'Optional product description', example: 'Ergonomic wireless mouse with 2.4GHz connectivity'),
    ]
)]
class StoreProductRequestSchema {}

#[OA\Schema(
    schema: 'UpdateProductRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, description: 'Product name', example: 'Wireless Mouse Pro'),
        new OA\Property(property: 'price', type: 'number', format: 'float', minimum: 0, description: 'Product price (must be >= 0)', example: 34.99),
        new OA\Property(property: 'quantity', type: 'integer', minimum: 0, description: 'Stock quantity (must be >= 0)', example: 75),
        new OA\Property(property: 'description', type: 'string', nullable: true, description: 'Product description', example: 'Updated ergonomic wireless mouse'),
    ]
)]
class UpdateProductRequestSchema {}

#[OA\Schema(
    schema: 'ReduceStockRequest',
    type: 'object',
    required: ['amount'],
    properties: [
        new OA\Property(property: 'amount', type: 'integer', minimum: 1, description: 'Amount to reduce from stock (must be >= 1)', example: 5),
    ]
)]
class ReduceStockRequestSchema {}
