<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

/**
 * @property mixed $role
 * @property mixed $email_verified_at
 * @property mixed $email
 * @property mixed $name
 * @property mixed $id
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    #[Pure]
    #[ArrayShape(['id' => "mixed", 'name' => "mixed", 'email' => "mixed", 'active' => "bool", 'role' => RoleResource::class])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'active' => (bool)$this->email_verified_at,
            'role' => new RoleResource($this->role),
        ];
    }
}
