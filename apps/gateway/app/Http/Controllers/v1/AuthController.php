<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Auth\Requests\LoginRequest;
use App\Http\Integrations\Auth\Requests\RegisterRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Auth\Requests\LoginRequest $loginRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login(Request $request, LoginRequest $loginRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $loginRequest->setData($request->all())->send()
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Auth\Requests\RegisterRequest $registerRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register(Request $request, RegisterRequest $registerRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $registerRequest->setData($request->all())->send()
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }
}
