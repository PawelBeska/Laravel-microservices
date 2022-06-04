<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    /**
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {

        $data = $request->validated();
        try {
            if (!Auth::attempt($data)) {
                return $this->errorResponse(
                    message: __('auth.failed'),
                    code: ResponseAlias::HTTP_UNAUTHORIZED);
            }
            if (!Auth::user()->email_verified_at) {
                return $this->errorResponse(
                    message: __('auth.needs_email_confirmation'),
                    code: ResponseAlias::HTTP_UNAUTHORIZED);
            }

            $accessToken = optional(Auth::user())->createToken('auth')->plainTextToken;


            $this->redisService->setAccessToken($accessToken, Auth::user());

            return $this->successResponse([
                'user' => new UserResource(Auth::user()),
                'access_token' => $accessToken,
            ]);
        } catch (Exception $e) {

            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }

    /**
     * @param \App\Http\Requests\RegisterRequest $request
     * @param \App\Services\UserService $userService
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request, UserService $userService): JsonResponse
    {
        $data = $request->validated();
        try {
            $user = $userService->assignData(
                $data['name'],
                $data['email'],
                $data['password'],
                now()
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            optional(Auth::user())->tokens()->delete();
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
