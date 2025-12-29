<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'PostComment',
    type: 'object',
    description: 'Post comment model',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique comment identifier', example: 1),
        new OA\Property(property: 'post_id', type: 'integer', description: 'Parent post ID', example: 1),
        new OA\Property(property: 'user_id', type: 'integer', description: 'User ID who created the comment', example: 1),
        new OA\Property(property: 'content', type: 'string', description: 'Comment content', example: 'Great post! Thanks for sharing.'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-01-02T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-01-02T00:00:00.000000Z'),
    ]
)]
class PostCommentSchema {}

#[OA\Schema(
    schema: 'StorePostCommentRequest',
    type: 'object',
    required: ['content'],
    properties: [
        new OA\Property(property: 'content', type: 'string', description: 'Comment text content', example: 'This is a great post!'),
    ]
)]
class StorePostCommentRequestSchema {}

#[OA\Schema(
    schema: 'UpdatePostCommentRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'content', type: 'string', description: 'Comment text content', example: 'Updated comment content'),
    ]
)]
class UpdatePostCommentRequestSchema {}

