<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Comment',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'task_id', type: 'integer', example: 1),
        new OA\Property(property: 'comment_text', type: 'string', example: 'Looks great, let\'s review it tomorrow.'),
        new OA\Property(property: 'author', type: 'string', example: 'John Doe'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2025-01-02T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2025-01-02T00:00:00.000000Z'),
    ]
)]
class CommentSchema {}
