<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Books',
    description: 'Book management endpoints'
)]
class BookController extends Controller
{
    #[OA\Get(
        path: '/api/books',
        summary: 'Get all books',
        tags: ['Books'],
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
                description: 'Paginated list of books',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Book')),
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
        $books = Book::with('categories')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        if ($this->wantsJson()) {
            return response()->json($books);
        }

        return view('books.index', compact('books'));
    }

    #[OA\Get(
        path: '/api/books/{book}',
        summary: 'Get a single book',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(
                name: 'book',
                in: 'path',
                required: true,
                description: 'Book ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Book details',
                content: new OA\JsonContent(ref: '#/components/schemas/Book')
            ),
            new OA\Response(response: 404, description: 'Book not found'),
        ]
    )]
    public function show(Book $book): JsonResponse|View
    {
        $book->load(['cover', 'reviews', 'categories']);

        if ($this->wantsJson()) {
            return response()->json($book);
        }

        return view('books.show', compact('book'));
    }

    #[OA\Post(
        path: '/api/books',
        summary: 'Create a new book',
        tags: ['Books'],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Book data',
            content: new OA\JsonContent(
                ref: '#/components/schemas/StoreBookRequest',
                example: [
                    'title' => 'Laravel: The Complete Guide',
                    'author' => 'Taylor Otwell',
                    'publication_year' => 2024,
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Book created successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Book')
            ),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('categories'));
    }

    public function store(StoreBookRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        
        // Extract cover data
        $coverData = null;
        if (isset($validated['cover_color']) || isset($validated['cover_format'])) {
            $coverData = [
                'color' => $validated['cover_color'] ?? null,
                'format' => $validated['cover_format'] ?? null,
            ];
            unset($validated['cover_color'], $validated['cover_format']);
        }
        
        // Extract categories
        $categories = $validated['categories'] ?? [];
        unset($validated['categories']);
        
        // Create book
        $book = Book::query()->create($validated);
        
        // Create cover if data provided
        if ($coverData && ($coverData['color'] || $coverData['format'])) {
            $book->cover()->create($coverData);
        }
        
        // Sync categories (sync with empty array if none provided)
        $book->categories()->sync($categories ?? []);

        if ($this->wantsJson()) {
            $book->load(['cover', 'categories']);
            return response()->json($book, 201);
        }

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    #[OA\Put(
        path: '/api/books/{book}',
        summary: 'Update a book',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(
                name: 'book',
                in: 'path',
                required: true,
                description: 'Book ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: 'The Great Gatsby'),
                    new OA\Property(property: 'author', type: 'string', example: 'F. Scott Fitzgerald'),
                    new OA\Property(property: 'publication_year', type: 'integer', example: 1925),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Book updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Book')
            ),
            new OA\Response(response: 404, description: 'Book not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    #[OA\Patch(
        path: '/api/books/{book}',
        summary: 'Partially update a book',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(
                name: 'book',
                in: 'path',
                required: true,
                description: 'Book ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: 'The Great Gatsby'),
                    new OA\Property(property: 'author', type: 'string', example: 'F. Scott Fitzgerald'),
                    new OA\Property(property: 'publication_year', type: 'integer', example: 1925),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Book updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Book')
            ),
            new OA\Response(response: 404, description: 'Book not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function edit(Book $book): View
    {
        $book->load(['cover', 'categories']);
        $categories = Category::orderBy('name')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(UpdateBookRequest $request, Book $book): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        
        // Extract cover data
        $coverData = null;
        if (isset($validated['cover_color']) || isset($validated['cover_format'])) {
            $coverData = [
                'color' => $validated['cover_color'] ?? null,
                'format' => $validated['cover_format'] ?? null,
            ];
            unset($validated['cover_color'], $validated['cover_format']);
        }
        
        // Extract categories
        $categories = $validated['categories'] ?? null;
        unset($validated['categories']);
        
        // Update book
        $book->update($validated);
        
        // Update or create cover if data provided
        if ($coverData !== null) {
            if ($coverData['color'] || $coverData['format']) {
                $book->cover()->updateOrCreate(
                    ['book_id' => $book->id],
                    $coverData
                );
            } else {
                // If both are empty, delete cover if it exists
                $book->cover()->delete();
            }
        }
        
        // Sync categories if provided
        if ($categories !== null) {
            $book->categories()->sync($categories);
        }

        if ($this->wantsJson()) {
            $book->load(['cover', 'categories']);
            return response()->json($book);
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    #[OA\Delete(
        path: '/api/books/{book}',
        summary: 'Delete a book',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(
                name: 'book',
                in: 'path',
                required: true,
                description: 'Book ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Book deleted successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Book deleted successfully'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Book not found'),
        ]
    )]
    public function destroy(Book $book): JsonResponse|RedirectResponse
    {
        $book->delete();

        if ($this->wantsJson()) {
            return response()->json(['message' => 'Book deleted successfully'], 200);
        }

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
