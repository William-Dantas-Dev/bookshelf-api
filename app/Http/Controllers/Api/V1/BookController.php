<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Book\BookControllerContract;
use App\DTO\BookDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Services\V1\BookService;

class BookController extends Controller implements BookControllerContract
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        try {
            $books = $this->bookService->index();
            if ($books->isEmpty()) {
                return response()->json([
                    'message' => 'No Books found',
                ], 404);
            }

            return response()->json([
                'message' => 'Books retrieved successfully',
                'books' => $books,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving Books',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $book = $this->bookService->show($id);
            if (!$book) {
                return response()->json([
                    'message' => 'Book not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Book retrieved successfully',
                'book' => $book,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving Book',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreBookRequest $request)
    {
        try {
            $book = $this->bookService->store(BookDTO::fromArray($request->all()));
            return response()->json([
                'message' => 'Book created successfully',
                'book' => $book,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating book',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateBookRequest $request, string $id)
    {
        try {
            $book = $this->bookService->update(BookDTO::fromArray($request->all()), $id);
            return response()->json([
                'message' => 'Book updated successfully',
                'book' => $book,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating book',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        $deleted = $this->bookService->destroy($id);

        if ($deleted) {
            return response()->json([
                'message' => 'Book deleted successfully.',
            ], 200);
        }
        return response()->json([
            'message' => 'Error trying to delete book.',
        ], 400);
    }
}
