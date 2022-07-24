<?php

namespace App\Http\Controllers\v1;

use App\Enum\NotificationTemplateTypeEnum;
use App\Enums\NotificationTemplateStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationTemplateRequest;
use App\Http\Requests\UpdateNotificationTemplateRequest;
use App\Http\Resources\NotificationTemplateCollection;
use App\Http\Resources\NotificationTemplateResource;
use App\Models\NotificationTemplate;
use App\Services\Notifications\NotificationFactory;
use App\Services\Notifications\NotificationTemplateService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NotificationTemplateController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authorizeResource(NotificationTemplate::class, 'notificationTemplate');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $notificationTemplates = NotificationTemplate::with(['data'])->paginate(
                Arr::get($request->all(), 'per_page', 15)
            );
            return $this->successResponse(
                new NotificationTemplateCollection($notificationTemplates)
            );

        } catch (Exception $e) {
            $this->reportError($e);
        }
    }

    /**
     * @param \App\Models\NotificationTemplate $notificationTemplate
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(NotificationTemplate $notificationTemplate): JsonResponse
    {
        $notificationTemplate->load(['data']);
        return $this->successResponse(
            new NotificationTemplateResource($notificationTemplate)
        );
    }

    /**
     * @param \App\Http\Requests\UpdateNotificationTemplateRequest $request
     * @param \App\Models\NotificationTemplate $notificationTemplate
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateNotificationTemplateRequest $request, NotificationTemplate $notificationTemplate): JsonResponse
    {
        $data = $request->validated();

        try {

            (new NotificationTemplateService($notificationTemplate))->assignData(
                $data['name'],
                $data['description'],
                NotificationTemplateTypeEnum::from($data['type']),
                NotificationTemplateStatusEnum::from($data['status']),
                $data['data']
            );
            return $this->successResponse(
                new NotificationTemplateResource($notificationTemplate)
            );

        } catch (Exception $e) {
            $this->reportError($e);
        }
    }

    /**
     * @param \App\Http\Requests\StoreNotificationTemplateRequest $request
     * @param \App\Services\Notifications\NotificationTemplateService $notificationTemplateService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreNotificationTemplateRequest $request, NotificationTemplateService $notificationTemplateService): JsonResponse
    {
        $data = $request->validated();

        try {

            $notificationTemplate = $notificationTemplateService->assignData(
                $data['name'],
                $data['description'],
                NotificationTemplateTypeEnum::from($data['type']),
                NotificationTemplateStatusEnum::from($data['status']),
                $data['data']
            )->getNotificationTemplate();

            return $this->successResponse(
                new NotificationTemplateResource($notificationTemplate)
            );

        } catch (Exception $e) {
            $this->reportError($e);
        }
    }

    /**
     * @param \App\Models\NotificationTemplate $notificationTemplate
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(NotificationTemplate $notificationTemplate): JsonResponse
    {
        try {
            $notificationTemplate->delete();
            return $this->successResponse();
        } catch (Exception $e) {
            $this->reportError($e);
        }
    }

}
