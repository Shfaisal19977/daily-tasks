<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Posts',
    description: 'Post management endpoints'
)]
class PostController extends Controller
{
    #[OA\Get(
        path: '/api/posts',
        summary: 'Get all posts',
        tags: ['Posts'],
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
                description: 'Paginated list of posts',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Post')),
                        new OA\Property(property: 'current_page', type: 'integer', example: 1),
                        new OA\Property(property: 'per_page', type: 'integer', example: 15),
                        new OA\Property(property: 'total', type: 'integer', example: 100),
                    ]
                )
            ),
        ]
    )]
    public function index(): JsonResponse|View
    {
        $perPage = request()->get('per_page', 15);
        $posts = Post::query()
            ->with(['user', 'categories'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        if ($this->wantsJson()) {
            return response()->json($posts);
        }

        return view('posts.index', compact('posts'));
    }

    #[OA\Post(
        path: '/api/posts',
        summary: 'Create a new post',
        description: 'Creates a new post with title, content, excerpt, user, and optional categories.',
        tags: ['Posts'],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Post data',
            content: new OA\JsonContent(
                example: [
                    'title' => 'My First Post',
                    'content' => 'This is the content of my post...',
                    'excerpt' => 'A brief excerpt',
                    'user_id' => 1,
                    'published_at' => '2025-12-20 15:00:00',
                    'categories' => [1, 2, 3],
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Post created successfully'
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error'
            ),
        ]
    )]
    public function create(): View
    {
        $users = User::all();
        $categories = Category::all();
        return view('posts.create', compact('users', 'categories'));
    }

    public function store(StorePostRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $categories = $validated['categories'] ?? [];
        unset($validated['categories']);

        $post = Post::query()->create($validated);
        
        if (!empty($categories)) {
            $post->categories()->attach($categories);
        }

        if ($this->wantsJson()) {
            return response()->json($post->load(['user', 'categories']), 201);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    #[OA\Get(
        path: '/api/posts/{post}',
        summary: 'Get a single post',
        description: 'Retrieves detailed information about a specific post by ID',
        tags: ['Posts'],
        parameters: [
            new OA\Parameter(
                name: 'post',
                in: 'path',
                required: true,
                description: 'Post ID',
                schema: new OA\Schema(type: 'integer'),
                example: 1
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Post details'
            ),
            new OA\Response(
                response: 404,
                description: 'Post not found'
            ),
        ]
    )]
    public function show(Post $post): JsonResponse|View
    {
        $post->load(['user', 'categories']);

        if ($this->wantsJson()) {
            return response()->json($post);
        }

        return view('posts.show', compact('post'));
    }

    #[OA\Put(
        path: '/api/posts/{post}',
        summary: 'Update a post',
        tags: ['Posts'],
        parameters: [
            new OA\Parameter(
                name: 'post',
                in: 'path',
                required: true,
                description: 'Post ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Post updated successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Post not found'
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error'
            ),
        ]
    )]
    #[OA\Patch(
        path: '/api/posts/{post}',
        summary: 'Partially update a post',
        tags: ['Posts'],
        parameters: [
            new OA\Parameter(
                name: 'post',
                in: 'path',
                required: true,
                description: 'Post ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Post updated successfully'
            ),
        ]
    )]
    public function edit(Post $post): View
    {
        $post->load(['categories']);
        $users = User::all();
        $categories = Category::all();
        return view('posts.edit', compact('post', 'users', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $categories = $validated['categories'] ?? null;
        unset($validated['categories']);

        $post->update($validated);

        if ($categories !== null) {
            $post->categories()->sync($categories);
        }

        if ($this->wantsJson()) {
            return response()->json($post->load(['user', 'categories']));
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    #[OA\Delete(
        path: '/api/posts/{post}',
        summary: 'Delete a post',
        tags: ['Posts'],
        parameters: [
            new OA\Parameter(
                name: 'post',
                in: 'path',
                required: true,
                description: 'Post ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Post deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Post deleted successfully'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Post not found'),
        ]
    )]
    public function destroy(Post $post): JsonResponse|RedirectResponse
    {
        $post->delete();

        if ($this->wantsJson()) {
            return response()->json(['message' => 'Post deleted successfully'], 200);
        }

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
