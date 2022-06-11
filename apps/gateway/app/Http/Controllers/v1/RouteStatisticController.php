<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Permission\Requests\PermissionDestroyRequest;
use App\Http\Integrations\Permission\Requests\PermissionIndexRequest;
use App\Http\Integrations\Permission\Requests\PermissionShowRequest;
use App\Http\Integrations\Permission\Requests\PermissionStoreRequest;
use App\Http\Integrations\Permission\Requests\PermissionUpdateRequest;
use App\Models\RouteStatistic;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RouteStatisticController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Permission\Requests\PermissionIndexRequest $permissionIndexRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, PermissionIndexRequest $permissionIndexRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $permissionIndexRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Permission\Requests\PermissionShowRequest $permissionShowRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, PermissionShowRequest $permissionShowRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $permissionShowRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }


}
