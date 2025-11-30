<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Product',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Laptop Stand'),
        new OA\Property(property: 'price', type: 'string', format: 'decimal', example: '49.99'),
        new OA\Property(property: 'quantity', type: 'integer', example: 100),
        new OA\Property(property: 'description', type: 'string', nullable: true, example: 'Adjustable aluminum laptop stand'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2025-11-30T18:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2025-11-30T18:00:00.000000Z'),
    ]
)]
class ProductSchema {}
