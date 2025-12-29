<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Profile',
    type: 'object',
    description: 'User profile model',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique profile identifier', example: 1),
        new OA\Property(property: 'user_id', type: 'integer', description: 'User ID', example: 1),
        new OA\Property(property: 'bio', type: 'string', nullable: true, description: 'User biography', example: 'Software developer passionate about Laravel'),
        new OA\Property(property: 'phone', type: 'string', nullable: true, description: 'Phone number', example: '+1234567890'),
        new OA\Property(property: 'address', type: 'string', nullable: true, description: 'Address', example: '123 Main St, City, Country'),
        new OA\Property(property: 'avatar', type: 'string', nullable: true, description: 'Avatar URL', example: 'https://example.com/avatar.jpg'),
        new OA\Property(property: 'date_of_birth', type: 'string', format: 'date', nullable: true, description: 'Date of birth', example: '1990-01-01'),
        new OA\Property(property: 'location', type: 'string', nullable: true, description: 'Location', example: 'New York, USA'),
        new OA\Property(property: 'website', type: 'string', format: 'url', nullable: true, description: 'Website URL', example: 'https://example.com'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-01-02T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-01-02T00:00:00.000000Z'),
    ]
)]
class ProfileSchema {}

