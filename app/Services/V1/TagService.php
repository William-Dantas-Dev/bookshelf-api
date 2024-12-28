<?php

namespace App\Services\V1;

use App\Contracts\Tag\TagServiceContract;
use App\DTO\TagDTO;
use App\Repositories\V1\TagRepository;

class TagService implements TagServiceContract
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        return $this->tagRepository->index();
    }

    public function show(string $id)
    {
        return $this->tagRepository->show($id);
    }

    public function store(TagDTO $tagDTO)
    {
        return $this->tagRepository->store($tagDTO);
    }

    public function update(TagDTO $tagDTO, string $id)
    {
        return $this->tagRepository->update($tagDTO, $id);
    }

    public function destroy(string $id)
    {
        return $this->tagRepository->destroy($id);
    }
}
