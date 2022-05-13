<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
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
            return $this->successResponse([
                'user' => Auth::user(),
                'access_token' => optional(Auth::user())->createToken('auth')->plainTextToken,
            ]);
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }

    public function register(RegisterRequest $request, UserService $userService): JsonResponse
    {
        $data = $request->validated();
        try {
            $user = (new UserService())->assignData(
                $data['name'],
                $data['email'],
                $data['password'],
                now()
            )->getUser();
            return $this->successResponse(
                $user
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __("Something went wrong.")
            );
        }
    }
}
