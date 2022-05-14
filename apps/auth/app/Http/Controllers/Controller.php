<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Http\Traits\Reportable;
use App\Services\RedisService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponse, Reportable;

    protected RedisService $redisService;

    public function __construct()
    {
        $this->redisService = app(RedisService::class);
    }
}
