<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Permission\Requests\PermissionDeleteRequest;
use App\Http\Integrations\Permission\Requests\PermissionDestroyRequest;
use App\Http\Integrations\Permission\Requests\PermissionIndexRequest;
use App\Http\Integrations\Permission\Requests\PermissionShowRequest;
use App\Http\Integrations\Permission\Requests\PermissionStoreRequest;
use App\Http\Integrations\Permission\Requests\PermissionUpdateRequest;
use App\Http\Integrations\User\Requests\UserIndexRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class PermissionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Permission\Requests\PermissionIndexRequest $permissionIndexRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(Request $request, PermissionIndexRequest $permissionIndexRequest): JsonResponse
    {
        ray(1);
        try {
            return $this->gatewayResponse(
                $permissionIndexRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    public function show(Request $request, PermissionShowRequest $permissionShowRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $permissionShowRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Permission\Requests\PermissionStoreRequest $permissionStoreRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, PermissionStoreRequest $permissionStoreRequest): JsonResponse
    {

    }

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Permission\Requests\PermissionUpdateRequest $permissionUpdateRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, PermissionUpdateRequest $permissionUpdateRequest):JsonResponse
    {

    }

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Permission\Requests\PermissionDestroyRequest $permissionDestroyRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, PermissionDestroyRequest $permissionDestroyRequest):JsonResponse
    {

    }


}
