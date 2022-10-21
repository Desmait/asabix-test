<?php

namespace App\Http\Resources;

use App\Http\Controllers\PaginationController;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;

class TagCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $response = [];
        foreach ($this->collection as $item) {
            $response[] = [
                'id' => $item->id,
                'name' => $item->name,
                'created_at' => Carbon::parse($item->created_at)->format('d-m-Y h:m:s'),
                'updated_at' => Carbon::parse($item->updated_at)->format('d-m-Y h:m:s')
            ];
        }

        $page = $request->page ?? 1;
        $perPage = $request->perPage ?? 10;
        return PaginationController::paginate($response, $perPage, $page);
    }
}
