<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ApiResponse
{

    public function gatewayResponse(SaloonResponse $response): JsonResponse
    {
        $data = $response->json();

        dd($data);
        return response()->json([
            'status' => Arr::get($data, 'status'),
            'message' => Arr::get($data, 'message'),
            'data' => Arr::get($data, 'data'),
            'code' => Arr::get($data, 'code')
        ], $response->status());
    }

    /**
     * @param mixed $data
     * @param int $customStatusCode
     * @return JsonResponse
     */

    public function successResponse(
        mixed $data,
        int   $customStatusCode = ResponseAlias::HTTP_OK
    ): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'data' => $data,
            'code' => $customStatusCode
        ], $customStatusCode);
    }

    /**
     * @param string|null $message
     * @param array|null $data
     * @param int $status
     * @return JsonResponse
     */

    public function errorResponse(
        string|null $message = null,
        array|null  $data = null,
        int         $status = ResponseAlias::HTTP_BAD_REQUEST
    ): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data,
            'code' => $status
        ], $status);
    }
}
