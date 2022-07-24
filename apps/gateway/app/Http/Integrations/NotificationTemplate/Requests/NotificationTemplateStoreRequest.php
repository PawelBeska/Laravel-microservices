<?php

namespace App\Http\Integrations\NotificationTemplate\Requests;

use App\Http\Integrations\NotificationTemplate\NotificationTemplateConnector;
use App\Http\Integrations\Role\RoleConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class NotificationTemplateStoreRequest extends SaloonRequest
{
    use HasJsonBody;
    /**
     * The connector class.
     *
     * @var string|null
     */
    protected ?string $connector = NotificationTemplateConnector::class;

    /**
     * The HTTP verb the request will use.
     *
     * @var string|null
     */
    protected ?string $method = Saloon::POST;

}
