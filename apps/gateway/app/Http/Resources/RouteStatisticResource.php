<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class RouteStatisticResource extends JsonResource
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
            "method" => $this->method,
            "type" => $this->type,
            "route" => $this->route,
            "ip" => $this->ip,
            "date" => $this->date,
            "counter" => $this->counter,
            "params" => RouteStatisticParamResource::collection($this->parameters),
        ];
    }
}
