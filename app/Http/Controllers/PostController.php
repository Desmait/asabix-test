<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->postRepository->getAllPosts($request->language_id));
    }

    public function store(Request $request): JsonResponse
    {
        $postDetails = $request->only([
            'title',
            'description',
            'content',
            'tags'
        ]);
        $postDetails['language_id'] = $request->language_id;

        return response()->json(
            [
                'data' => $this->postRepository->createPost($postDetails)
            ],
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request): JsonResponse
    {
        $postId = $request->route('id');

        return response()->json([
            'data' => $this->postRepository->getPostById($postId, $request->language_id)
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $postId = $request->route('id');
        $postDetails = $request->only([
            'title',
            'description',
            'content',
            'tags'
        ]);
        $postDetails['language_id'] = $request->language_id;

        return response()->json([
            'data' => $this->postRepository->updatePost($postId, $postDetails)
        ]);
    }

    public function delete(Request $request): JsonResponse
    {
        $postId = $request->route('id');
        $this->postRepository->deletePost($postId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
