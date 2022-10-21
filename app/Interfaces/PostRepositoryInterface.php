<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPosts($language_id);
    public function getPostById($postId, $language_id);
    public function deletePost($postId);
    public function createPost(array $postDetails);
    public function updatePost($postId, array $newDetails);
}
