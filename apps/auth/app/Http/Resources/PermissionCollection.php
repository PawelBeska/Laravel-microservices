<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
/**
 * @method total()
 * @method perPage()
 * @method currentPage()
 * @method lastPage()
 */
class PermissionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    #[ArrayShape(['data' => AnonymousResourceCollection::class, 'pagination' => "array"])]
    public function toArray($request): array
    {
        return [
            'data' => PermissionResource::collection($this->collection),
            'pagination' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ]
        ];
    }
}
