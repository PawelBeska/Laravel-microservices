<?php

namespace App\Http\Integrations\User;

use App\Http\Integrations\User\Requests\UserIndexRequest;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;

class UserConnector extends SaloonConnector
{
    use AcceptsJson;

    protected array $requests = [
        UserIndexRequest::class
    ];

    /**
     * The Base URL of the API.
     *
     * @return string
     */
    public function defineBaseUrl(): string
    {
        return 'http://webserver:81/api/v1';
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
