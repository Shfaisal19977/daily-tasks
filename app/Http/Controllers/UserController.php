<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Users',
    description: 'User management endpoints'
)]
class UserController extends Controller
{
    #[OA\Get(
        path: '/api/users',
        summary: 'Get all users',
        tags: ['Users'],
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
                description: 'Paginated list of users',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/User')),
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
        $users = User::query()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        if ($this->wantsJson()) {
            return response()->json($users);
        }

        return view('users.index', compact('users'));
    }

    #[OA\Get(
        path: '/api/users/{user}',
        summary: 'Get a single user',
        description: 'Retrieves detailed information about a specific user by ID',
        tags: ['Users'],
        parameters: [
            new OA\Parameter(
                name: 'user',
                in: 'path',
                required: true,
                description: 'User ID',
                schema: new OA\Schema(type: 'integer'),
                example: 1
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'User details',
                content: new OA\JsonContent(ref: '#/components/schemas/User')
            ),
            new OA\Response(
                response: 404,
                description: 'User not found',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'No query results for model [App\\Models\\User] 999'),
                    ]
                )
            ),
        ]
    )]
    public function show(User $user): JsonResponse|View
    {
        if ($this->wantsJson()) {
            return response()->json($user);
        }

        return view('users.show', compact('user'));
    }

    #[OA\Get(
        path: '/api/profile',
        summary: 'Get authenticated user profile',
        description: 'Retrieves the profile information of the authenticated user',
        tags: ['Users'],
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: 'User profile details',
                content: new OA\JsonContent(ref: '#/components/schemas/User')
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function showProfile(): JsonResponse|View|RedirectResponse
    {
        $user = auth()->user() ?? User::first();

        if (!$user) {
            if ($this->wantsJson()) {
                return response()->json(['message' => 'No user found'], 404);
            }
            return redirect()->route('home')->with('error', 'No user found.');
        }

        if ($this->wantsJson()) {
            return response()->json($user);
        }

        return view('users.profile', compact('user'));
    }

    #[OA\Put(
        path: '/api/profile',
        summary: 'Update authenticated user profile',
        description: 'Updates the profile information of the authenticated user',
        tags: ['Users'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Profile data to update',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'bio', type: 'string', maxLength: 1000, nullable: true, example: 'Software developer passionate about Laravel'),
                    new OA\Property(property: 'phone', type: 'string', maxLength: 20, nullable: true, example: '+1234567890'),
                    new OA\Property(property: 'address', type: 'string', maxLength: 500, nullable: true, example: '123 Main St, City, Country'),
                    new OA\Property(property: 'avatar', type: 'string', maxLength: 255, nullable: true, example: 'https://example.com/avatar.jpg'),
                    new OA\Property(property: 'date_of_birth', type: 'string', format: 'date', nullable: true, example: '1990-01-01'),
                    new OA\Property(property: 'location', type: 'string', maxLength: 255, nullable: true, example: 'New York, USA'),
                    new OA\Property(property: 'website', type: 'string', format: 'url', maxLength: 255, nullable: true, example: 'https://example.com'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Profile updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/User')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'The given data was invalid.'),
                        new OA\Property(property: 'errors', type: 'object'),
                    ]
                )
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    #[OA\Patch(
        path: '/api/profile',
        summary: 'Update authenticated user profile',
        description: 'Updates the profile information of the authenticated user',
        tags: ['Users'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Profile data to update',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'bio', type: 'string', maxLength: 1000, nullable: true),
                    new OA\Property(property: 'phone', type: 'string', maxLength: 20, nullable: true),
                    new OA\Property(property: 'address', type: 'string', maxLength: 500, nullable: true),
                    new OA\Property(property: 'avatar', type: 'string', maxLength: 255, nullable: true),
                    new OA\Property(property: 'date_of_birth', type: 'string', format: 'date', nullable: true),
                    new OA\Property(property: 'location', type: 'string', maxLength: 255, nullable: true),
                    new OA\Property(property: 'website', type: 'string', format: 'url', maxLength: 255, nullable: true),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Profile updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/User')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function updateProfile(UpdateProfileRequest $request): JsonResponse|RedirectResponse
    {
        $user = auth()->user() ?? User::first();

        if (!$user) {
            if ($this->wantsJson()) {
                return response()->json(['message' => 'No user found'], 404);
            }
            return redirect()->route('home')->with('error', 'No user found.');
        }

        $user->update($request->validated());
        $user->refresh();

        if ($this->wantsJson()) {
            return response()->json($user);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    public function editProfile(): View|RedirectResponse
    {
        $user = auth()->user() ?? User::first();

        if (!$user) {
            return redirect()->route('home')->with('error', 'No user found.');
        }

        return view('users.edit-profile', compact('user'));
    }
}
