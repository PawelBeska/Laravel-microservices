<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Role\Requests\RoleDestroyRequest;
use App\Http\Integrations\Role\Requests\RoleIndexRequest;
use App\Http\Integrations\Role\Requests\RoleShowRequest;
use App\Http\Integrations\Role\Requests\RoleStoreRequest;
use App\Http\Integrations\Role\Requests\RoleUpdateRequest;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Role\Requests\RoleIndexRequest $roleIndexRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, RoleIndexRequest $roleIndexRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $roleIndexRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Role\Requests\RoleShowRequest $roleShowRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, RoleShowRequest $roleShowRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $roleShowRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Role\Requests\RoleStoreRequest $roleStoreRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, RoleStoreRequest $roleStoreRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $roleStoreRequest->setData($request->toArray())->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Role\Requests\RoleUpdateRequest $roleUpdateRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, RoleUpdateRequest $roleUpdateRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $roleUpdateRequest->setData($request->toArray())->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Role\Requests\RoleDestroyRequest $roleDestroyRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, RoleDestroyRequest $roleDestroyRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $roleDestroyRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }


}
