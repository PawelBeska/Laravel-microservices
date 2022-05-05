<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Http\Traits\Reportable;
use App\Services\ApiService;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ApiResponse, Reportable;
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }
}
