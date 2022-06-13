<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class RouteStatisticParamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'name' => "mixed", 'description' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            "type" => $this->type,
            "key" => $this->key,
            "value" => $this->value,
            "counter" => $this->counter,
        ];
    }
}
