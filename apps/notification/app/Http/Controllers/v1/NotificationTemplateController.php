<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationTemplateRequest;
use App\Http\Requests\UpdateNotificationTemplateRequest;
use App\Models\NotificationTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationTemplateController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authorizeResource(NotificationTemplate::class, 'notificationTemplate');
    }

    public function index(): JsonResponse
    {

    }

    public function show(NotificationTemplate $notificationTemplate): JsonResponse
    {

    }

    public function update(UpdateNotificationTemplateRequest $request ,NotificationTemplate $notificationTemplate): JsonResponse
    {

    }

    public function store(StoreNotificationTemplateRequest $request): JsonResponse
    {

    }

    public function delete(NotificationTemplate $notificationTemplate): JsonResponse
    {

    }

}
