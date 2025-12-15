<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ProjectController as ApiProjectController;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Projects',
    description: 'Project management endpoints'
)]
class ProjectController extends Controller
{
    public function __construct(
        private readonly ApiProjectController $apiController
    ) {}

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
    public function index(): View
    {
        $response = $this->apiController->index();
        $projects = json_decode($response->getContent(), true);

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

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $this->apiController->store($request);

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
    public function show(Project $project): View
    {
        $response = $this->apiController->show($project);
        $projectData = json_decode($response->getContent(), true);

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

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $this->apiController->update($request, $project);

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
    public function destroy(Project $project): RedirectResponse
    {
        $this->apiController->destroy($project);

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
