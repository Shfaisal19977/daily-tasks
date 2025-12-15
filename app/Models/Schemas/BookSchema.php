<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Book',
    type: 'object',
    description: 'Book model with title, author, and publication year',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique book identifier', example: 1),
        new OA\Property(property: 'title', type: 'string', description: 'Book title', example: 'The Great Gatsby'),
        new OA\Property(property: 'author', type: 'string', description: 'Book author name', example: 'F. Scott Fitzgerald'),
        new OA\Property(property: 'publication_year', type: 'integer', description: 'Year of publication (4 digits)', example: 1925),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-01-01T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-01-01T00:00:00.000000Z'),
    ]
)]
class BookSchema {}

#[OA\Schema(
    schema: 'StoreBookRequest',
    type: 'object',
    required: ['title', 'author', 'publication_year'],
    properties: [
        new OA\Property(property: 'title', type: 'string', description: 'Book title', example: 'Laravel: The Complete Guide'),
        new OA\Property(property: 'author', type: 'string', description: 'Book author name', example: 'Taylor Otwell'),
        new OA\Property(property: 'publication_year', type: 'integer', description: 'Year of publication (must be 4 digits)', example: 2024),
    ]
)]
class StoreBookRequestSchema {}

#[OA\Schema(
    schema: 'UpdateBookRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'title', type: 'string', description: 'Book title', example: 'Laravel: The Complete Guide (2nd Edition)'),
        new OA\Property(property: 'author', type: 'string', description: 'Book author name', example: 'Taylor Otwell'),
        new OA\Property(property: 'publication_year', type: 'integer', description: 'Year of publication (must be 4 digits)', example: 2025),
    ]
)]
class UpdateBookRequestSchema {}
