<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateDestroyRequest;
use App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateIndexRequest;
use App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateShowRequest;
use App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateStoreRequest;
use App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateUpdateRequest;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationTemplateController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateIndexRequest $notificationTemplateIndexRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, NotificationTemplateIndexRequest $notificationTemplateIndexRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $notificationTemplateIndexRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateShowRequest $notificationTemplateShowRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, NotificationTemplateShowRequest $notificationTemplateShowRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $notificationTemplateShowRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateStoreRequest $notificationTemplateStoreRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, NotificationTemplateStoreRequest $notificationTemplateStoreRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $notificationTemplateStoreRequest->setData($request->toArray())->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateUpdateRequest $notificationTemplateUpdateRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, NotificationTemplateUpdateRequest $notificationTemplateUpdateRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $notificationTemplateUpdateRequest->setData($request->toArray())->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateDestroyRequest $notificationTemplateDestroyRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, NotificationTemplateDestroyRequest $notificationTemplateDestroyRequest): JsonResponse
    {
        try {
            return $this->gatewayResponse(
                $notificationTemplateDestroyRequest->withTokenAuth($request->bearerToken())->send()
            );
        } catch (GuzzleException|Exception $e) {
            $this->reportError($e);
            return $this->errorResponse(__('Something went wrong.'));
        }
    }


}
