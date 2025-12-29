<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'User',
    type: 'object',
    description: 'User model',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique user identifier', example: 1),
        new OA\Property(property: 'name', type: 'string', description: 'User name', example: 'John Doe'),
        new OA\Property(property: 'email', type: 'string', format: 'email', description: 'User email address', example: 'john@example.com'),
        new OA\Property(property: 'email_verified_at', type: 'string', format: 'date-time', nullable: true, description: 'Email verification timestamp', example: '2025-01-02T00:00:00.000000Z'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-01-02T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-01-02T00:00:00.000000Z'),
    ]
)]
class UserSchema {}

