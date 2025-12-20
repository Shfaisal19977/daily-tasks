<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Profiles',
    description: 'User profile management endpoints'
)]
class ProfileController extends Controller
{
    #[OA\Get(
        path: '/api/profile',
        summary: 'Get authenticated user profile',
        description: 'Retrieves the profile information of the authenticated user',
        tags: ['Profiles'],
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: 'User profile details',
                content: new OA\JsonContent(ref: '#/components/schemas/Profile')
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function show(): JsonResponse|View|RedirectResponse
    {
        $user = auth()->user() ?? User::first();

        if (!$user) {
            if ($this->wantsJson()) {
                return response()->json(['message' => 'No user found'], 404);
            }
            return redirect()->route('home')->with('error', 'No user found.');
        }

        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);

        if ($this->wantsJson()) {
            return response()->json($profile);
        }

        return view('users.profile', compact('user', 'profile'));
    }

    public function edit(): View|RedirectResponse
    {
        $user = auth()->user() ?? User::first();

        if (!$user) {
            return redirect()->route('home')->with('error', 'No user found.');
        }

        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);

        return view('users.edit-profile', compact('user', 'profile'));
    }

    #[OA\Put(
        path: '/api/profile',
        summary: 'Update authenticated user profile',
        description: 'Updates the profile information of the authenticated user',
        tags: ['Profiles'],
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
                content: new OA\JsonContent(ref: '#/components/schemas/Profile')
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
        tags: ['Profiles'],
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
                content: new OA\JsonContent(ref: '#/components/schemas/Profile')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function update(UpdateProfileRequest $request): JsonResponse|RedirectResponse
    {
        $user = auth()->user() ?? User::first();

        if (!$user) {
            if ($this->wantsJson()) {
                return response()->json(['message' => 'No user found'], 404);
            }
            return redirect()->route('home')->with('error', 'No user found.');
        }

        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);
        $profile->update($request->validated());
        $profile->refresh();

        if ($this->wantsJson()) {
            return response()->json($profile);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
