<?php

namespace App\Http\Integrations\Role\Requests;

use App\Http\Integrations\Role\RoleConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;

class RoleShowRequest extends SaloonRequest
{
    /**
     * The connector class.
     *
     * @var string|null
     */
    protected ?string $connector = RoleConnector::class;

    /**
     * The HTTP verb the request will use.
     *
     * @var string|null
     */
    protected ?string $method = Saloon::GET;

    /**
     * The endpoint of the request.
     *
     * @return string
     */
    public function defineEndpoint(): string
    {
        return '/' . request()->role;
    }

}
