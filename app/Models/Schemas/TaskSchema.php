<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Task',
    type: 'object',
    description: 'Task model with priority, status, and due date',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique task identifier', example: 1),
        new OA\Property(property: 'project_id', type: 'integer', description: 'Parent project ID', example: 1),
        new OA\Property(property: 'title', type: 'string', description: 'Task title', example: 'Design Homepage'),
        new OA\Property(property: 'details', type: 'string', nullable: true, description: 'Task details and description', example: 'Create mockups and high-fidelity designs for the homepage. Include mobile and desktop versions.'),
        new OA\Property(property: 'status', type: 'string', maxLength: 50, description: 'Task status (e.g., pending, in_progress, completed)', example: 'in_progress'),
        new OA\Property(property: 'priority', type: 'string', maxLength: 50, description: 'Task priority (e.g., low, medium, high, urgent)', example: 'high'),
        new OA\Property(property: 'due_date', type: 'string', format: 'date', nullable: true, description: 'Task due date (YYYY-MM-DD)', example: '2025-01-15'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-01-01T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-01-01T00:00:00.000000Z'),
    ]
)]
class TaskSchema {}

#[OA\Schema(
    schema: 'StoreTaskRequest',
    type: 'object',
    required: ['title', 'status', 'priority'],
    properties: [
        new OA\Property(property: 'title', type: 'string', maxLength: 255, description: 'Task title', example: 'Implement User Authentication'),
        new OA\Property(property: 'details', type: 'string', nullable: true, description: 'Task details', example: 'Implement JWT-based authentication with refresh tokens'),
        new OA\Property(property: 'status', type: 'string', maxLength: 50, description: 'Task status', example: 'in_progress'),
        new OA\Property(property: 'priority', type: 'string', maxLength: 50, description: 'Task priority', example: 'high'),
        new OA\Property(property: 'due_date', type: 'string', format: 'date', nullable: true, description: 'Task due date (YYYY-MM-DD)', example: '2025-02-15'),
    ]
)]
class StoreTaskRequestSchema {}

#[OA\Schema(
    schema: 'UpdateTaskRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'title', type: 'string', maxLength: 255, description: 'Task title', example: 'Implement User Authentication v2'),
        new OA\Property(property: 'details', type: 'string', nullable: true, description: 'Task details', example: 'Updated authentication with OAuth2 support'),
        new OA\Property(property: 'status', type: 'string', maxLength: 50, description: 'Task status', example: 'completed'),
        new OA\Property(property: 'priority', type: 'string', maxLength: 50, description: 'Task priority', example: 'medium'),
        new OA\Property(property: 'due_date', type: 'string', format: 'date', nullable: true, description: 'Task due date (YYYY-MM-DD)', example: '2025-02-20'),
    ]
)]
class UpdateTaskRequestSchema {}
