<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
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
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of books',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Book')
                )
            ),
        ]
    )]
    public function index(): JsonResponse|View
    {
        $books = Book::query()
            ->orderBy('created_at', 'desc')
            ->get();

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
        return view('books.create');
    }

    public function store(StoreBookRequest $request): JsonResponse|RedirectResponse
    {
        $book = Book::query()->create($request->validated());

        if ($this->wantsJson()) {
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
        return view('books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, Book $book): JsonResponse|RedirectResponse
    {
        $book->update($request->validated());

        if ($this->wantsJson()) {
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
