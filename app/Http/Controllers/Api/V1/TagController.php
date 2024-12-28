<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\User\TagControllerContract;
use App\DTO\TagDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Services\V1\TagService;

class TagController extends Controller implements TagControllerContract
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        try {
            $tags = $this->tagService->index();
            if ($tags->isEmpty()) {
                return response()->json([
                    'message' => 'No tags found',
                ], 404);
            }

            return response()->json([
                'message' => 'Tags retrieved successfully',
                'tags' => $tags,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving tags',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $tag = $this->tagService->show($id);
            if (!$tag) {
                return response()->json([
                    'message' => 'Tag not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Tag retrieved successfully',
                'tag' => $tag,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving tag',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function store(StoreTagRequest $request)
    {
        try {
            $tag = $this->tagService->store(TagDTO::fromArray($request->all()));
            return response()->json([
                'message' => 'Tag created successfully',
                'tag' => $tag,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating tag',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateTagRequest $request, string $id)
    {
        try {
            $tag = $this->tagService->update(TagDTO::fromArray($request->all()), $id);
            return response()->json([
                'message' => 'Tag updated successfully',
                'tag' => $tag,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating tag',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        $deleted = $this->tagService->destroy($id);

        if($deleted) {
            return response()->json([
                'message' => 'Tag deleted successfully.',
            ], 200);
        }
        return response()->json([
            'message' => 'Error trying to delete tag.',
        ], 400);
    }
}
