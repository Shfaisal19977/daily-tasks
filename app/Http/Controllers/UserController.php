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
