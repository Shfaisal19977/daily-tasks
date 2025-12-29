<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Post',
    type: 'object',
    description: 'Post model',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique post identifier', example: 1),
        new OA\Property(property: 'title', type: 'string', description: 'Post title', example: 'Getting Started with Laravel'),
        new OA\Property(property: 'content', type: 'string', description: 'Post content', example: 'Laravel is a powerful PHP framework...'),
        new OA\Property(property: 'excerpt', type: 'string', nullable: true, description: 'Post excerpt', example: 'A brief introduction to Laravel framework'),
        new OA\Property(property: 'user_id', type: 'integer', description: 'User ID who created the post', example: 1),
        new OA\Property(property: 'published_at', type: 'string', format: 'date-time', nullable: true, description: 'Publication timestamp', example: '2025-01-02T00:00:00.000000Z'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-01-02T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-01-02T00:00:00.000000Z'),
    ]
)]
class PostSchema {}

#[OA\Schema(
    schema: 'StorePostRequest',
    type: 'object',
    required: ['title', 'content'],
    properties: [
        new OA\Property(property: 'title', type: 'string', maxLength: 255, description: 'Post title', example: 'Getting Started with Laravel'),
        new OA\Property(property: 'content', type: 'string', description: 'Post content', example: 'Laravel is a powerful PHP framework...'),
        new OA\Property(property: 'excerpt', type: 'string', nullable: true, description: 'Post excerpt', example: 'A brief introduction to Laravel framework'),
        new OA\Property(property: 'published_at', type: 'string', format: 'date-time', nullable: true, description: 'Publication timestamp', example: '2025-01-02T00:00:00.000000Z'),
    ]
)]
class StorePostRequestSchema {}

#[OA\Schema(
    schema: 'UpdatePostRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'title', type: 'string', maxLength: 255, description: 'Post title', example: 'Updated Post Title'),
        new OA\Property(property: 'content', type: 'string', description: 'Post content', example: 'Updated post content...'),
        new OA\Property(property: 'excerpt', type: 'string', nullable: true, description: 'Post excerpt', example: 'Updated excerpt'),
        new OA\Property(property: 'published_at', type: 'string', format: 'date-time', nullable: true, description: 'Publication timestamp', example: '2025-01-02T00:00:00.000000Z'),
    ]
)]
class UpdatePostRequestSchema {}

