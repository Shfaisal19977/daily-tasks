<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Project',
    type: 'object',
    description: 'Project model with tasks and timeline information',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique project identifier', example: 1),
        new OA\Property(property: 'name', type: 'string', description: 'Project name', example: 'Website Redesign'),
        new OA\Property(property: 'description', type: 'string', nullable: true, description: 'Project description', example: 'Complete redesign of company website for better user experience and modern design'),
        new OA\Property(property: 'start_date', type: 'string', format: 'date', nullable: true, description: 'Project start date (YYYY-MM-DD)', example: '2025-01-01'),
        new OA\Property(property: 'end_date', type: 'string', format: 'date', nullable: true, description: 'Project end date (YYYY-MM-DD). Must be after or equal to start_date', example: '2025-06-30'),
        new OA\Property(property: 'status', type: 'string', nullable: true, description: 'Project status (e.g., planned, in_progress, completed)', example: 'in_progress'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-01-01T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-01-01T00:00:00.000000Z'),
    ]
)]
class ProjectSchema {}

#[OA\Schema(
    schema: 'StoreProjectRequest',
    type: 'object',
    required: ['name'],
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, description: 'Project name', example: 'Mobile App Development'),
        new OA\Property(property: 'description', type: 'string', nullable: true, description: 'Project description', example: 'Develop a cross-platform mobile application for iOS and Android'),
        new OA\Property(property: 'start_date', type: 'string', format: 'date', nullable: true, description: 'Project start date (YYYY-MM-DD)', example: '2025-02-01'),
        new OA\Property(property: 'end_date', type: 'string', format: 'date', nullable: true, description: 'Project end date (YYYY-MM-DD). Must be after or equal to start_date', example: '2025-08-31'),
        new OA\Property(property: 'status', type: 'string', maxLength: 50, nullable: true, description: 'Project status', example: 'planned'),
    ]
)]
class StoreProjectRequestSchema {}

#[OA\Schema(
    schema: 'UpdateProjectRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, description: 'Project name', example: 'Mobile App Development v2'),
        new OA\Property(property: 'description', type: 'string', nullable: true, description: 'Project description', example: 'Updated project scope with additional features'),
        new OA\Property(property: 'start_date', type: 'string', format: 'date', nullable: true, description: 'Project start date (YYYY-MM-DD)', example: '2025-02-15'),
        new OA\Property(property: 'end_date', type: 'string', format: 'date', nullable: true, description: 'Project end date (YYYY-MM-DD)', example: '2025-09-30'),
        new OA\Property(property: 'status', type: 'string', maxLength: 50, nullable: true, description: 'Project status', example: 'in_progress'),
    ]
)]
class UpdateProjectRequestSchema {}
