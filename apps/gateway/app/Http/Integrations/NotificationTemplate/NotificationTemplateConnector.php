<?php

namespace App\Http\Integrations\NotificationTemplate;

use App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateDestroyRequest;
use App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateIndexRequest;
use App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateShowRequest;
use App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateStoreRequest;
use App\Http\Integrations\NotificationTemplate\Requests\NotificationTemplateUpdateRequest;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;

class NotificationTemplateConnector extends SaloonConnector
{
    use AcceptsJson;


    /**
     * @var array|string[]
     */
    protected array $requests = [
        NotificationTemplateDestroyRequest::class,
        NotificationTemplateIndexRequest::class,
        NotificationTemplateShowRequest::class,
        NotificationTemplateStoreRequest::class,
        NotificationTemplateUpdateRequest::class,
    ];

    /**
     * The Base URL of the API.
     *
     * @return string
     */
    public function defineBaseUrl(): string
    {
        return 'http://webserver:81/api/v1/notification-templates';
    }

    /**
     * The headers that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultHeaders(): array
    {
        return [];
    }

    /**
     * The config options that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultConfig(): array
    {
        return [];
    }
}
