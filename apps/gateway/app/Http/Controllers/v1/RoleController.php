<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Role\Requests\RoleIndexRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Role\Requests\RoleIndexRequest $roleIndexRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(Request $request, RoleIndexRequest $roleIndexRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $roleIndexRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }


}
