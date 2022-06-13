<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Permission\Requests\PermissionDestroyRequest;
use App\Http\Integrations\Permission\Requests\PermissionIndexRequest;
use App\Http\Integrations\Permission\Requests\PermissionShowRequest;
use App\Http\Integrations\Permission\Requests\PermissionStoreRequest;
use App\Http\Integrations\Permission\Requests\PermissionUpdateRequest;
use App\Http\Resources\RouteStatisticCollection;
use App\Http\Resources\RouteStatisticResource;
use App\Models\RouteStatistic;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RouteStatisticController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->successResponse(
                new RouteStatisticCollection(RouteStatistic::with(['parameters'])->paginate(Arr::get($request->all(), 'per_page', 15)))
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RouteStatistic $routeStatistic
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, RouteStatistic $routeStatistic): JsonResponse
    {
        try {
            return $this->successResponse(
                new RouteStatisticResource($routeStatistic)
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }


}
