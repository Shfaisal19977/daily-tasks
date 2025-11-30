<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Task',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'project_id', type: 'integer', example: 1),
        new OA\Property(property: 'title', type: 'string', example: 'Design Homepage'),
        new OA\Property(property: 'details', type: 'string', nullable: true, example: 'Create mockups and high-fidelity designs.'),
        new OA\Property(property: 'status', type: 'string', example: 'in_progress'),
        new OA\Property(property: 'priority', type: 'string', example: 'high'),
        new OA\Property(property: 'due_date', type: 'string', format: 'date', nullable: true, example: '2025-01-15'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2025-01-01T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2025-01-01T00:00:00.000000Z'),
    ]
)]
class TaskSchema {}
