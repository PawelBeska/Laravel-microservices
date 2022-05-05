<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ]);

        try {
            Auth::attempt($data);
            return $this->successResponse(
                [
                    "user" => Auth::user()
                ]
            );
        } catch (\Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(
                __('some error has occurred.')
            );
        }

    }

    public function register(): JsonResponse
    {

    }
}
