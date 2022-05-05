<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiService
{


    /**
     * @param string $url
     * @param string $method
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function makeCall(
        string $url,
        string $method = Request::METHOD_GET,
        array  $data = []
    ): array
    {

        return match ($method) {
            Request::METHOD_GET => Http::get($url, $data)->json(),
            Request::METHOD_POST => Http::post($url, $data)->json(),
            Request::METHOD_DELETE => Http::delete($url, $data)->json(),
            Request::METHOD_PUT => Http::put($url, $data)->json(),
            default => throw new Exception("Unknown request method: " . $method)
        };

    }
}
