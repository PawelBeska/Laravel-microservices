<?php

namespace App\Http\Integrations\User;

use App\Http\Integrations\User\Requests\UserDestroyRequest;
use App\Http\Integrations\User\Requests\UserIndexRequest;
use App\Http\Integrations\User\Requests\UserShowRequest;
use App\Http\Integrations\User\Requests\UserStoreRequest;
use App\Http\Integrations\User\Requests\UserUpdateRequest;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;

class UserConnector extends SaloonConnector
{
    use AcceptsJson;

    /**
     * @var array|string[]
     */
    protected array $requests = [
        UserDestroyRequest::class,
        UserIndexRequest::class,
        UserShowRequest::class,
        UserStoreRequest::class,
        UserUpdateRequest::class,
    ];

    /**
     * The Base URL of the API.
     *
     * @return string
     */
    public function defineBaseUrl(): string
    {
        return 'http://webserver:81/api/v1/user';
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
