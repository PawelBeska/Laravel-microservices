<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->successResponse(
            new UserCollection(User::with(['role', 'role.permissions'])->paginate(Arr::get($request->all(), 'per_page', 15)))
        );
    }

    /**
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return $this->successResponse(
            new UserResource($user->with(['role', 'role.permissions'])->first())
        );
    }

    /**
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();
        try {

           $user = (new UserService($user))
                ->assignData(
                    $data['name'],
                    $data['email'],
                    Arr::get($data, 'password'),
                    Arr::get($data, 'email_verified_at'),
                    Role::findorfail($data['role_id'])
                )->getUser();

            return $this->successResponse(
                new UserResource($user)
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }


    /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @param \App\Services\UserService $userService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request, UserService $userService): JsonResponse
    {
        $data = $request->validated();
        try {

            $user = $userService
                ->assignData(
                    $data['name'],
                    $data['email'],
                    Arr::get($data, 'password'),
                    Arr::get($data, 'email_verified_at'),
                    Role::findorfail($data['role_id'])
                )->getUser();

            return $this->successResponse(
                new UserResource($user)
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }

    /**
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $user->delete();
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
