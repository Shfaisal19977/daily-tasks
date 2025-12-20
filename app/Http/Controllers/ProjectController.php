<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
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
        parameters: [
            new OA\Parameter(
                name: 'per_page',
                in: 'query',
                required: false,
                description: 'Number of items per page',
                schema: new OA\Schema(type: 'integer', default: 15)
            ),
            new OA\Parameter(
                name: 'page',
                in: 'query',
                required: false,
                description: 'Page number',
                schema: new OA\Schema(type: 'integer', default: 1)
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Paginated list of projects',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Project')),
                        new OA\Property(property: 'current_page', type: 'integer', example: 1),
                        new OA\Property(property: 'per_page', type: 'integer', example: 15),
                        new OA\Property(property: 'total', type: 'integer', example: 100),
                        new OA\Property(property: 'last_page', type: 'integer', example: 7),
                        new OA\Property(property: 'from', type: 'integer', example: 1),
                        new OA\Property(property: 'to', type: 'integer', example: 15),
                    ]
                )
            ),
        ]
    )]
    public function index(): JsonResponse|View
    {
        $perPage = request()->get('per_page', 15);
        $projects = Project::query()
            ->with('tasks.comments')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        if ($this->wantsJson()) {
            return response()->json($projects);
        }

        return view('projects.index', compact('projects'));
    }

    #[OA\Post(
        path: '/api/projects',
        summary: 'Create a new project',
        tags: ['Projects'],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Project data',
            content: new OA\JsonContent(
                ref: '#/components/schemas/StoreProjectRequest',
                example: [
                    'name' => 'Mobile App Development',
                    'description' => 'Develop a cross-platform mobile application for iOS and Android',
                    'start_date' => '2025-02-01',
                    'end_date' => '2025-08-31',
                    'status' => 'planned',
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Project created successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Project',
                    example: [
                        'id' => 1,
                        'name' => 'Mobile App Development',
                        'description' => 'Develop a cross-platform mobile application',
                        'start_date' => '2025-02-01',
                        'end_date' => '2025-08-31',
                        'status' => 'planned',
                        'created_at' => '2025-01-15T10:00:00.000000Z',
                        'updated_at' => '2025-01-15T10:00:00.000000Z',
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'The name field is required.'),
                        new OA\Property(property: 'errors', type: 'object', example: ['name' => ['The name field is required.']]),
                    ]
                )
            ),
        ]
    )]
    public function create(): View
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request): JsonResponse|RedirectResponse
    {
        $project = Project::query()->create($request->validated());

        if ($this->wantsJson()) {
            return response()->json($project, 201);
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    #[OA\Get(
        path: '/api/projects/{project}',
        summary: 'Get a single project',
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
        responses: [
            new OA\Response(
                response: 200,
                description: 'Project details',
                content: new OA\JsonContent(ref: '#/components/schemas/Project')
            ),
            new OA\Response(response: 404, description: 'Project not found'),
        ]
    )]
    public function show(Project $project): JsonResponse|View
    {
        $project->load('tasks.comments');

        if ($this->wantsJson()) {
            return response()->json($project);
        }

        return view('projects.show', compact('project'));
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
    public function edit(Project $project): View
    {
        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse|RedirectResponse
    {
        $project->update($request->validated());

        if ($this->wantsJson()) {
            return response()->json($project);
        }

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    #[OA\Delete(
        path: '/api/projects/{project}',
        summary: 'Delete a project',
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
        responses: [
            new OA\Response(
                response: 200,
                description: 'Project deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Project deleted successfully'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Project not found'),
        ]
    )]
    public function destroy(Project $project): JsonResponse|RedirectResponse
    {
        $project->delete();

        if ($this->wantsJson()) {
            return response()->json(['message' => 'Project deleted successfully'], 200);
        }

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
