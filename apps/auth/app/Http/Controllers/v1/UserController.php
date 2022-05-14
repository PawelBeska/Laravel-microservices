<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return $this->successResponse(
            new UserResource(Auth::user())
        );
    }
}
