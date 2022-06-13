<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\User\Requests\UserDestroyRequest;
use App\Http\Integrations\User\Requests\UserIndexRequest;
use App\Http\Integrations\User\Requests\UserShowRequest;
use App\Http\Integrations\User\Requests\UserStoreRequest;
use App\Http\Integrations\User\Requests\UserUpdateRequest;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\User\Requests\UserIndexRequest $userIndexRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, UserIndexRequest $userIndexRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $userIndexRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\User\Requests\UserShowRequest $userShowRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, UserShowRequest $userShowRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $userShowRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\User\Requests\UserStoreRequest $userStoreRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, UserStoreRequest $userStoreRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $userStoreRequest->setData($request->toArray())->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\User\Requests\UserUpdateRequest $userUpdateRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, UserUpdateRequest $userUpdateRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $userUpdateRequest->setData($request->toArray())->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\User\Requests\UserDestroyRequest $userDestroyRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, UserDestroyRequest $userDestroyRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $userDestroyRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }


}
