<?php

namespace App\Http\Controllers;

use App\Interfaces\TagRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    private TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->tagRepository->getAllTags());
    }

    public function store(Request $request): JsonResponse
    {
        $tagDetails = $request->only([
            'name'
        ]);

        return response()->json(
            [
                'data' => $this->tagRepository->createTag($tagDetails)
            ],
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request): JsonResponse
    {
        $tagId = $request->route('id');

        return response()->json([
            'data' => $this->tagRepository->getTagById($tagId)
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $tagId = $request->route('id');
        $tagDetails = $request->only([
            'name'
        ]);

        return response()->json([
            'data' => $this->tagRepository->updateTag($tagId, $tagDetails)
        ]);
    }

    public function delete(Request $request): JsonResponse
    {
        $tagId = $request->route('id');
        $this->tagRepository->deleteTag($tagId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
