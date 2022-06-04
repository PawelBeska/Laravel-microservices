<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RoleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authorizeResource(Role::class, 'role');
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->successResponse(
                new RoleCollection(Role::with(['permissions'])->paginate(Arr::get($request->all(), 'per_page', 15)))
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }

    }

    /**
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Role $role): JsonResponse
    {
        try {
            return $this->successResponse(
                new RoleResource($role)
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }

    /**
     * @param \App\Http\Requests\RoleUpdateRequest $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleUpdateRequest $request, Role $role): JsonResponse
    {
        $data = $request->validated();
        try {

            $role = (new RoleService($role))
                ->assignData(
                    $data['name'],
                    Arr::get($data, 'permissions')
                )->getRole();

            return $this->successResponse(
                new RoleResource($role)
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }


    /**
     * @param \App\Http\Requests\RoleStoreRequest $request
     * @param \App\Services\RoleService $roleService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleStoreRequest $request, RoleService $roleService): JsonResponse
    {
        $data = $request->validated();
        try {

            $role = $roleService
                ->assignData(
                    $data['name'],
                    Arr::get($data, 'permissions')
                )->getRole();

            return $this->successResponse(
                new RoleResource($role)
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }

    /**
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        try {
            $role->delete();
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
