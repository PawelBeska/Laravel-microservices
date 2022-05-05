<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|bool
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse|bool
    {
        try {
            return
                $this->successResponse(
                    $this->apiService->makeCall(
                        "http://laravel-microservices-blockchain_webserver_1/api/v1/auth/login",
                        Request::METHOD_POST,
                        $request->all()
                    )
                );
        } catch (\Exception $e) {
            $this->reportError($e);
            abort(500);
        }
    }

    public function register()
    {

    }
}
