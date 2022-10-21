<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->postTranslation->title,
            'description' => $this->postTranslation->description,
            'content' => $this->postTranslation->content,
            'tags' => (new TagCollection($this->tags))->paginate(false),
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y h:m:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d-m-Y h:m:s')
        ];
    }
}
