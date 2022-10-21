<?php

namespace App\Repositories;

use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{
    public function getAllTags()
    {
        return new TagCollection(Tag::all());
    }

    public function getTagById($tagId)
    {
        return new TagResource(Tag::findOrFail($tagId));
    }

    public function deleteTag($tagId)
    {
        Tag::destroy($tagId);
    }

    public function createTag(array $tagDetails)
    {
        return new TagResource(Tag::create($tagDetails));
    }

    public function updateTag($tagId, array $newDetails)
    {
        return Tag::whereId($tagId)->update($newDetails);
    }
}
