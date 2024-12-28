<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\User\GenreControllerContract;
use App\DTO\GenreDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Genre\StoreGenreRequest;
use App\Http\Requests\Genre\UpdateGenreRequest;
use App\Services\V1\GenreService;

class GenreController extends Controller implements GenreControllerContract
{
    protected $genreService;

    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    public function index()
    {
        try {
            $genres = $this->genreService->index();
            if ($genres->isEmpty()) {
                return response()->json([
                    'message' => 'No genres found',
                ], 404);
            }

            return response()->json([
                'message' => 'Genres retrieved successfully',
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
            $genre = $this->genreService->show($id);
            if (!$genre) {
                return response()->json([
                    'message' => 'Genre not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Genre retrieved successfully',
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
            $genre = $this->genreService->store(GenreDTO::fromArray($request->all()));
            return response()->json([
                'message' => 'Genre created successfully',
                'genre' => $genre,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating genre',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateGenreRequest $request, string $id)
    {
        try {
            $genre = $this->genreService->update(GenreDTO::fromArray($request->all()), $id);
            return response()->json([
                'message' => 'Genre updated successfully',
                'genre' => $genre,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating genre',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        $deleted = $this->genreService->destroy($id);

        if($deleted) {
            return response()->json([
                'message' => 'Genre deleted successfully.',
            ], 200);
        }
        return response()->json([
            'message' => 'Error trying to delete genre.',
        ], 400);
    }
}
