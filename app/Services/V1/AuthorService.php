<?php

namespace App\Services\V1;

use App\Contracts\Author\AuthorServiceContract;
use App\DTO\AuthorDTO;
use App\Repositories\V1\AuthorRepository;

class AuthorService implements AuthorServiceContract
{
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index()
    {
        return $this->authorRepository->index();
    }

    public function show(string $id)
    {
        return $this->authorRepository->show($id);
    }

    public function store(AuthorDTO $authorDTO)
    {
        return $this->authorRepository->store($authorDTO);
    }

    public function update(AuthorDTO $authorDTO, string $id)
    {
        return $this->authorRepository->update($authorDTO, $id);
    }

    public function destroy(string $id)
    {
        return $this->authorRepository->destroy($id);
    }
}
