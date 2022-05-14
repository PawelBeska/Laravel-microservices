<?php

namespace App\Providers;

use App\Services\RedisService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use JetBrains\PhpStorm\Pure;

class RedisUserProvider implements UserProvider
{

    private RedisService $redisService;

    #[Pure]
    public function __construct()
    {
        $this->redisService = new RedisService();
    }

    public function retrieveById($identifier): ?Authenticatable
    {
        throw new \RuntimeException("Function retrieveById() is not implemented.");
    }

    public function retrieveByToken($identifier, $token): bool|array|Authenticatable|null
    {
        return $this->redisService->getUserByAccessToken($token);
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        throw new \RuntimeException("Function retrieveById() is not implemented.");
    }

    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        throw new \RuntimeException("Function retrieveById() is not implemented.");
    }

    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        throw new \RuntimeException("Function retrieveById() is not implemented.");
    }
}
