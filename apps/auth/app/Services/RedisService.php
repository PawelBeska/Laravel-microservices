<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Redis;

class RedisService
{


    /**
     * @param string $key
     * @param int $expiration
     * @return void
     */
    public function setExpiration(string $key, int $expiration): void
    {
        Redis::expire($key, $expiration);
    }

    /**
     * @param string $key
     * @param string|int|null $value
     * @param int $expiration
     */
    public function setEx(string $key, null|string|int $value, int $expiration): void
    {
        Redis::setex($key, $expiration, $value);
    }

    /**
     * @param string $key
     * @param array $array
     * @param int $expiration
     * @return void
     */
    public function setExArray(string $key, array $array, int $expiration): void
    {
        foreach ($array as $hashKey => $value) {
            $this->set($key, $hashKey, $value);
        }
        $this->setExpiration($key, $expiration);
    }

    /**
     * @param string $key
     * @param array $array
     * @return void
     */
    public function setArray(string $key, array $array): void
    {
        foreach ($array as $hashKey => $value) {
            $this->set($key, $hashKey, $value);
        }
    }

    /**
     * @param string $key
     * @param string $hashKey
     * @param string|int $value
     * @return void
     */

    public function set(string $key, string $hashKey, string|int $value): void
    {
        Redis::hset(
            $key,
            $hashKey,
            $value
        );
    }

    /**
     * @param string $key
     * @param string|null $hashKey
     * @return mixed
     */

    public function get(string $key, ?string $hashKey = null): mixed
    {
        return Redis::hget(
            $key,
            $hashKey
        );
    }


    public function delete(string $key): void
    {
        Redis::del($key);
    }

    /**
     * @param string $accessToken
     * @param \Illuminate\Contracts\Auth\Authenticatable|\App\Models\User $user
     * @return void
     */
    public function setAccessToken(string $accessToken, Authenticatable|User $user): void
    {
        $this->setEx($accessToken, (new UserResource($user))->toJson(), Carbon::now()->addDay()->diffInSeconds());
    }

    /**
     * @param $accessToken
     * @return false|array
     * @throws \JsonException
     */
    public function getUserByAccessToken($accessToken): ?array
    {

        $data = Redis::get($accessToken);
        if ($data) {
            return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        }
        return null;
    }
}
