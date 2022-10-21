<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()->all()], Response::HTTP_BAD_REQUEST);
        }

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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()->all()], Response::HTTP_BAD_REQUEST);
        }

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
