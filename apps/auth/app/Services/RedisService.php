<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class RedisService
{

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
}
