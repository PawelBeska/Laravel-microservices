<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Profile\Requests\ProfileIndexRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\Profile\Requests\ProfileIndexRequest $profileIndexRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(Request $request, ProfileIndexRequest $profileIndexRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $profileIndexRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }


}
