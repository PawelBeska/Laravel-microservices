<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use App\Http\Resources\PermissionCollection;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Services\PermissionService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function __construct()
    {

        $this->authorizeResource(Permission::class, 'permission');
        parent::__construct();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->successResponse(
                new PermissionCollection(Permission::paginate(Arr::get($request->all(), 'per_page', 15)))
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }

    /**
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Permission $permission): JsonResponse
    {
        try {
            return $this->successResponse(
                new PermissionResource($permission)
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }

    /**
     * @param \App\Http\Requests\PermissionStoreRequest $request
     * @param \App\Services\PermissionService $permissionService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionStoreRequest $request, PermissionService $permissionService): JsonResponse
    {
        $data = $request->validated();
        try {

            $permission = $permissionService->assignData(
                $data['name'],
                $data['description']
            )->getPermission();

            return $this->successResponse(
                new PermissionResource($permission)
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }

    /**
     * @param \App\Http\Requests\PermissionStoreRequest $request
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PermissionStoreRequest $request, Permission $permission): JsonResponse
    {
        $data = $request->validated();
        try {

            $permission = (new PermissionService($permission))->assignData(
                $data['name'],
                $data['description']
            )->getPermission();

            return $this->successResponse(
                new PermissionResource($permission)
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }

    /**
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Permission $permission): JsonResponse
    {
        try {
            $permission->delete();
            return $this->successResponse(
                null
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }
}
