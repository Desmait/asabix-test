<?php

namespace App\Repositories;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts($language_id)
    {
        $posts = Post::with('postTranslation', 'tags')
            ->whereHas('postTranslation', function ($query) use ($language_id) {
                return $query->where('language_id', $language_id);
            })->get();

        return new PostCollection($posts);
    }

    public function getPostById($postId, $language_id)
    {
        $post = Post::with('postTranslation', 'tags')
            ->whereHas('postTranslation', function ($query) use ($language_id) {
                return $query->where('language_id', $language_id);
            })->findOrFail($postId);

        return new PostResource($post ?? []);
    }

    public function deletePost($postId)
    {
        Post::destroy($postId);
    }

    public function createPost(array $postDetails)
    {
        $post = Post::create();

        $postTranslation = new PostTranslation();
        $postTranslation->title = $postDetails['title'];
        $postTranslation->description = $postDetails['description'];
        $postTranslation->content = $postDetails['content'];
        $postTranslation->post_id = $post->id;
        $postTranslation->language_id = $postDetails['language_id'];
        $postTranslation->save();

        $tags = Tag::find($postDetails['tags']);
        $post->tags()->attach($tags);

        return $this->getPostById($post->id, $postDetails['language_id']);
    }

    public function updatePost($postId, array $newDetails)
    {
        $post = Post::findOrFail($postId);
        $post->tags()->sync($newDetails['tags']);
        unset($newDetails['tags']);
        $post->postTranslation()->updateOrCreate($newDetails);


        return $this->getPostById($postId, $newDetails['language_id']);
    }
}
