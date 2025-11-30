<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Projects',
    description: 'Project management endpoints'
)]
class ProjectController extends Controller
{
    #[OA\Get(
        path: '/api/projects',
        summary: 'Get all projects',
        tags: ['Projects'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of projects',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Project')
                )
            ),
        ]
    )]
    public function index(): JsonResponse
    {
        $projects = Project::query()
            ->with('tasks.comments')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($projects);
    }

    #[OA\Post(
        path: '/api/projects',
        summary: 'Create a new project',
        tags: ['Projects'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Website Redesign'),
                    new OA\Property(property: 'description', type: 'string', example: 'Complete redesign of company website'),
                    new OA\Property(property: 'start_date', type: 'string', format: 'date', example: '2025-01-01'),
                    new OA\Property(property: 'end_date', type: 'string', format: 'date', example: '2025-03-31'),
                    new OA\Property(property: 'status', type: 'string', example: 'planned'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Project created successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Project')
            ),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = Project::query()->create($request->validated());

        return response()->json($project, 201);
    }

    #[OA\Put(
        path: '/api/projects/{project}',
        summary: 'Update a project',
        tags: ['Projects'],
        parameters: [
            new OA\Parameter(
                name: 'project',
                in: 'path',
                required: true,
                description: 'Project ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Website Redesign'),
                    new OA\Property(property: 'description', type: 'string', example: 'Complete redesign of company website'),
                    new OA\Property(property: 'start_date', type: 'string', format: 'date', example: '2025-01-01'),
                    new OA\Property(property: 'end_date', type: 'string', format: 'date', example: '2025-03-31'),
                    new OA\Property(property: 'status', type: 'string', example: 'planned'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Project updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Project')
            ),
            new OA\Response(response: 404, description: 'Project not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    #[OA\Patch(
        path: '/api/projects/{project}',
        summary: 'Partially update a project',
        tags: ['Projects'],
        parameters: [
            new OA\Parameter(
                name: 'project',
                in: 'path',
                required: true,
                description: 'Project ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Website Redesign'),
                    new OA\Property(property: 'description', type: 'string', example: 'Complete redesign of company website'),
                    new OA\Property(property: 'start_date', type: 'string', format: 'date', example: '2025-01-01'),
                    new OA\Property(property: 'end_date', type: 'string', format: 'date', example: '2025-03-31'),
                    new OA\Property(property: 'status', type: 'string', example: 'planned'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Project updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Project')
            ),
            new OA\Response(response: 404, description: 'Project not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $project->update($request->validated());

        return response()->json($project);
    }
}
