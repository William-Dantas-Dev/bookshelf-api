<?php

namespace App\Services\V1;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Repositories\V1\BookRepository;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        try {
            $books = $this->bookRepository->index();

            if ($books->isEmpty()) {
                return response()->json([
                    'message' => 'No books found',
                ], 404);
            }

            return response()->json([
                'message' => 'books retrieved successfully',
                'books' => $books,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving books',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $book = $this->bookRepository->show($id);
            if (!$book) {
                return response()->json([
                    'message' => 'book not found',
                ], 404);
            }

            return response()->json([
                'message' => 'book retrieved successfully',
                'book' => $book,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving book',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreBookRequest $request)
    {
        try {
            $book = $this->bookRepository->store($request);
            return response()->json([
                'message' => 'Book created successfully.',
                'data' => $book
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating book.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function update(string $id, UpdateBookRequest $request)
    {
        try {
            $book = $this->bookRepository->update($request, $id);
            if (!$request) {
                return response()->json([
                    'message' => 'Book not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Book updated successfully',
                'book' => $book
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating Book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(string $id)
    {
        $deleted = $this->bookRepository->delete($id);

        if ($deleted) {
            return response()->json([
                'message' => 'Book deleted successfully.',
            ], 200);
        }
        return response()->json([
            'message' => 'Error trying to delete Book.',
        ], 400);
    }
}
