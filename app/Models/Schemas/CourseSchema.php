<?php

namespace App\Models\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Course',
    type: 'object',
    description: 'Course model',
    properties: [
        new OA\Property(property: 'id', type: 'integer', description: 'Unique course identifier', example: 1),
        new OA\Property(property: 'name', type: 'string', description: 'Course name', example: 'Mathematics 101'),
        new OA\Property(property: 'teacher_id', type: 'integer', description: 'Teacher ID who teaches this course', example: 1),
        new OA\Property(property: 'teacher', type: 'object', nullable: true, description: 'Associated teacher object', ref: '#/components/schemas/Teacher'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Creation timestamp', example: '2025-01-02T00:00:00.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', description: 'Last update timestamp', example: '2025-01-02T00:00:00.000000Z'),
    ]
)]
class CourseSchema {}

#[OA\Schema(
    schema: 'StoreCourseRequest',
    type: 'object',
    required: ['name', 'teacher_id'],
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, description: 'Course name', example: 'Mathematics 101'),
        new OA\Property(property: 'teacher_id', type: 'integer', description: 'Teacher ID who teaches this course', example: 1),
    ]
)]
class StoreCourseRequestSchema {}

#[OA\Schema(
    schema: 'UpdateCourseRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, description: 'Course name', example: 'Advanced Mathematics 101'),
        new OA\Property(property: 'teacher_id', type: 'integer', description: 'Teacher ID who teaches this course', example: 1),
    ]
)]
class UpdateCourseRequestSchema {}

#[OA\Schema(
    schema: 'AttachCoursesRequest',
    type: 'object',
    required: ['courses'],
    properties: [
        new OA\Property(
            property: 'courses',
            type: 'array',
            description: 'Array of courses to attach',
            items: new OA\Items(
                type: 'object',
                properties: [
                    new OA\Property(property: 'name', type: 'string', description: 'Course name', example: 'Mathematics 101'),
                ]
            ),
            example: [
                ['name' => 'Mathematics 101'],
                ['name' => 'Physics 201'],
            ]
        ),
    ]
)]
class AttachCoursesRequestSchema {}

#[OA\Schema(
    schema: 'SyncStudentsRequest',
    type: 'object',
    required: ['student_ids'],
    properties: [
        new OA\Property(
            property: 'student_ids',
            type: 'array',
            description: 'Array of student IDs to sync to the course',
            items: new OA\Items(type: 'integer'),
            example: [1, 2, 3]
        ),
    ]
)]
class SyncStudentsRequestSchema {}

