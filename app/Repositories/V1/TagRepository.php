<?php

namespace App\Repositories\V1;

use App\Contracts\Tag\TagRepositoryContract;
use App\DTO\TagDTO;
use App\Models\Tag;

class TagRepository implements TagRepositoryContract
{

    public function index()
    {
        return Tag::all();
    }

    public function show(string $id)
    {
        return Tag::findOrFail($id);
    }

    public function store(TagDTO $tagDTO)
    {
        return Tag::create($tagDTO->toArray());
    }

    public function update(TagDTO $tagDTO, string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update($tagDTO->toArray());
        return $tag;
    }

    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        if (!$tag) return false;
        return $tag->delete();
    }
}
