<?php

namespace App\Http\Integrations\Auth;

use App\Http\Integrations\Auth\Requests\LoginRequest;
use App\Http\Integrations\Auth\Requests\RegisterRequest;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;

/**
 * @method LoginRequest loginRequest()
 * @method RegisterRequest registerRequest()
 */
class AuthConnector extends SaloonConnector
{
    use AcceptsJson;

    protected array $requests = [
        LoginRequest::class,
        RegisterRequest::class,
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
