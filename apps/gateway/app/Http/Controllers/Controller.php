<?php

namespace App\Http\Controllers;

use App\Services\RedisService;
use App\Http\Traits\ApiResponse;
use App\Http\Traits\Reportable;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ApiResponse, Reportable;

    protected RedisService $redisService;

    public function __construct()
    {
        $this->redisService = app(RedisService::class);
    }
}
