<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Auth\AuthConnector;
use App\Http\Integrations\Auth\Requests\LoginRequest;
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
            return $this->successResponse(123);
        }

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Auth\AuthConnector $authConnector
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request, AuthConnector $authConnector): JsonResponse
    {
        return $this->successResponse(
            $authConnector->registerRequest()->setData($request->all())
        );
    }
}
