<?php

namespace App\Http\Integrations\Permission;

use App\Http\Integrations\Role\Requests\RoleDestroyRequest;
use App\Http\Integrations\Role\Requests\RoleIndexRequest;
use App\Http\Integrations\Role\Requests\RoleShowRequest;
use App\Http\Integrations\Role\Requests\RoleStoreRequest;
use App\Http\Integrations\Role\Requests\RoleUpdateRequest;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;

class PermissionConnector extends SaloonConnector
{
    use AcceptsJson;

    /**
     * @var array|string[]
     */
    protected array $requests = [
        RoleDestroyRequest::class,
        RoleIndexRequest::class,
        RoleShowRequest::class,
        RoleStoreRequest::class,
        RoleUpdateRequest::class,
    ];

    /**
     * The Base URL of the API.
     *
     * @return string
     */
    public function defineBaseUrl(): string
    {
        return 'http://webserver:81/api/v1/permission';
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
