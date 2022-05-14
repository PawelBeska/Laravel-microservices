<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\User\Requests\UserIndexRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\User\Requests\UserIndexRequest $userIndexRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(Request $request, UserIndexRequest $userIndexRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $userIndexRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }


}
