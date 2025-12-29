<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Teacher',
    type: 'object',
    description: 'Teacher model',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique teacher identifier', example: 1),
        new OA\Property(property: 'user_id', type: 'integer', description: 'User ID associated with the teacher', example: 1),
        new OA\Property(property: 'user', type: 'object', nullable: true, description: 'Associated user object', ref: '#/components/schemas/User'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-01-02T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-01-02T00:00:00.000000Z'),
    ]
)]
class TeacherSchema {}

#[OA\Schema(
    schema: 'StoreTeacherRequest',
    type: 'object',
    required: ['user_id'],
    properties: [
        new OA\Property(property: 'user_id', type: 'integer', description: 'User ID to associate with the teacher', example: 1),
    ]
)]
class StoreTeacherRequestSchema {}

#[OA\Schema(
    schema: 'UpdateTeacherRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'user_id', type: 'integer', description: 'User ID to associate with the teacher', example: 1),
    ]
)]
class UpdateTeacherRequestSchema {}

