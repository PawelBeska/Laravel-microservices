<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ApiResponse
{
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
        array|string|null $message = null,
        int         $code = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
        int         $status = ResponseAlias::HTTP_BAD_REQUEST,
    ): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'code' => $code
        ], $status);
    }
}
