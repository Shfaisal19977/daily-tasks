<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Book',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'title', type: 'string', example: 'The Great Laravel Book'),
        new OA\Property(property: 'author', type: 'string', example: 'Jane Doe'),
        new OA\Property(property: 'publication_year', type: 'integer', example: 2023),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2025-01-01T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2025-01-01T00:00:00.000000Z'),
    ]
)]
class BookSchema {}
