<?php

namespace App\Services\V1;

use App\Contracts\Genre\GenreServiceContract;
use App\DTO\GenreDTO;
use App\Repositories\V1\GenreRepository;

class GenreService implements GenreServiceContract
{
    protected $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function index()
    {
        return $this->genreRepository->index();
    }

    public function show(string $id)
    {
        return $this->genreRepository->show($id);
    }

    public function store(GenreDTO $genreDTO)
    {
        return $this->genreRepository->store($genreDTO);
    }

    public function update(GenreDTO $genreDTO, string $id)
    {
        return $this->genreRepository->update($genreDTO, $id);
    }

    public function destroy(string $id)
    {
        return $this->genreRepository->destroy($id);
    }
}
