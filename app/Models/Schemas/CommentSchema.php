<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Comment',
    type: 'object',
    description: 'Comment model for task collaboration',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique comment identifier', example: 1),
        new OA\Property(property: 'task_id', type: 'integer', description: 'Parent task ID', example: 1),
        new OA\Property(property: 'comment_text', type: 'string', description: 'Comment content', example: 'The design looks great! Let\'s schedule a review meeting tomorrow to discuss the implementation details.'),
        new OA\Property(property: 'author', type: 'string', description: 'Comment author name', example: 'John Doe'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-01-02T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-01-02T00:00:00.000000Z'),
    ]
)]
class CommentSchema {}

#[OA\Schema(
    schema: 'StoreCommentRequest',
    type: 'object',
    required: ['comment_text', 'author'],
    properties: [
        new OA\Property(property: 'comment_text', type: 'string', description: 'Comment text content', example: 'This implementation looks solid. We should test it thoroughly before deployment.'),
        new OA\Property(property: 'author', type: 'string', maxLength: 255, description: 'Comment author name', example: 'Jane Smith'),
    ]
)]
class StoreCommentRequestSchema {}

#[OA\Schema(
    schema: 'UpdateCommentRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'comment_text', type: 'string', description: 'Comment text content', example: 'Updated: After review, we need to add error handling.'),
        new OA\Property(property: 'author', type: 'string', maxLength: 255, description: 'Comment author name', example: 'Jane Smith'),
    ]
)]
class UpdateCommentRequestSchema {}
