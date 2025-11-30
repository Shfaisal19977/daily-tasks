<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Project',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Website Redesign'),
        new OA\Property(property: 'description', type: 'string', nullable: true, example: 'Redesign the company website for better UX.'),
        new OA\Property(property: 'start_date', type: 'string', format: 'date', nullable: true, example: '2025-01-01'),
        new OA\Property(property: 'end_date', type: 'string', format: 'date', nullable: true, example: '2025-06-30'),
        new OA\Property(property: 'status', type: 'string', nullable: true, example: 'in_progress'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2025-01-01T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2025-01-01T00:00:00.000000Z'),
    ]
)]
class ProjectSchema {}
