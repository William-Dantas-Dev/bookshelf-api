<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\User\AuthorControllerContract;
use App\DTO\AuthorDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Services\V1\AuthorService;

class AuthorController extends Controller implements AuthorControllerContract
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        try {
            $authors = $this->authorService->index();
            if ($authors->isEmpty()) {
                return response()->json([
                    'message' => 'No authors found',
                ], 404);
            }

            return response()->json([
                'message' => 'Authors retrieved successfully',
                'authors' => $authors,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving authors',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $author = $this->authorService->show($id);
            if (!$author) {
                return response()->json([
                    'message' => 'Author not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Author retrieved successfully',
                'author' => $author,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving author',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function store(StoreAuthorRequest $request)
    {
        try {
            $author = $this->authorService->store(AuthorDTO::fromArray($request->all()));
            return response()->json([
                'message' => 'Author created successfully',
                'author' => $author,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating author',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateAuthorRequest $request, string $id)
    {
        try {
            $author = $this->authorService->update(AuthorDTO::fromArray($request->all()), $id);
            return response()->json([
                'message' => 'Author updated successfully',
                'author' => $author,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating author',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        $deleted = $this->authorService->destroy($id);

        if($deleted) {
            return response()->json([
                'message' => 'Author deleted successfully.',
            ], 200);
        }
        return response()->json([
            'message' => 'Error trying to delete author.',
        ], 400);
    }
}
