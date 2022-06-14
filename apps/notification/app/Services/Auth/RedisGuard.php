<?php

namespace App\Services\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RedisGuard implements Guard
{

    public ?array $user = null;

    /**
     * @param \Illuminate\Contracts\Auth\UserProvider $provider
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(
        public UserProvider $provider,
        public Request      $request)
    {
        $this->user = $provider->retrieveByToken(
            identifier: null,
            token: $request->bearerToken()
        );
    }

    public function check(): bool
    {
        return (bool)$this->user;
    }

    public function guest(): bool
    {
        return !(bool)$this->user;
    }

    public function user(): array|Authenticatable|null
    {
        if ($this->user) {
            return $this->user;
        }
        return null;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission): bool
    {
        if (!$this->user || Arr::get($this->user, 'role.permissions', false)) {
            return false;
        }
        return in_array($permission, Arr::get($this->user, 'role.permissions', []), true);
    }


    public function id()
    {
        return Arr::get($this->user, 'id');
    }

    public function validate(array $credentials = [])
    {
        // TODO: Implement validate() method.
    }

    public function hasUser()
    {
        // TODO: Implement hasUser() method.
    }

    public function setUser(Authenticatable $user)
    {
        // TODO: Implement setUser() method.
    }
}
