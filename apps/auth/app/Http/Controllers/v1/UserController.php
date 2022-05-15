<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return $this->successResponse(
            new UserCollection(User::paginate(Arr::get($request->all(), 'per_page', 15)))
        );
    }
}
