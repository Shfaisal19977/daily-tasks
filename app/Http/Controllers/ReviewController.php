<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * Store a newly created review for a book.
     */
    public function store(StoreReviewRequest $request, Book $book): RedirectResponse
    {
        $book->reviews()->create($request->validated());

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Review added successfully.');
    }

    /**
     * Remove the specified review.
     */
    public function destroy(Book $book, Review $review): RedirectResponse
    {
        // Ensure the review belongs to the book
        if ($review->book_id !== $book->id) {
            abort(404);
        }

        $review->delete();

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Review deleted successfully.');
    }
}
