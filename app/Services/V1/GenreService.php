<?php

namespace App\Services\V1;

use App\Http\Requests\Genre\StoreGenreRequest;
use App\Http\Requests\Genre\UpdateGenreRequest;
use App\Repositories\V1\GenreRepository;

class GenreService
{
    protected $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function index()
    {
        try {
            $genres = $this->genreRepository->index();

            if ($genres->isEmpty()) {
                return response()->json([
                    'message' => 'No genres found',
                ], 404);
            }

            return response()->json([
                'message' => 'genres retrieved successfully',
                'genres' => $genres,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving genres',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $genre = $this->genreRepository->show($id);
            if (!$genre) {
                return response()->json([
                    'message' => 'genre not found',
                ], 404);
            }

            return response()->json([
                'message' => 'genre retrieved successfully',
                'genre' => $genre,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving genre',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreGenreRequest $request)
    {
        try {
            $genre = $this->genreRepository->store($request);
            return response()->json([
                'message' => 'Genre created successfully.',
                'data' => $genre
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating genre.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function update(string $id, UpdateGenreRequest $request)
    {
        try {
            $genre = $this->genreRepository->update($request, $id);
            if (!$request) {
                return response()->json([
                    'message' => 'Genre not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Genre updated successfully',
                'genre' => $genre
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating Genre',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(string $id)
    {
        $deleted = $this->genreRepository->delete($id);

        if ($deleted) {
            return response()->json([
                'message' => 'Genre deleted successfully.',
            ], 200);
        }
        return response()->json([
            'message' => 'Error trying to delete Genre.',
        ], 400);
    }
}
