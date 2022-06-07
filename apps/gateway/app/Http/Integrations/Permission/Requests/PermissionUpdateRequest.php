<?php

namespace App\Http\Integrations\Permission\Requests;

use App\Http\Integrations\Permission\PermissionConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;

class PermissionUpdateRequest extends SaloonRequest
{
    /**
     * The connector class.
     *
     * @var string|null
     */
    protected ?string $connector = PermissionConnector::class;

    /**
     * The HTTP verb the request will use.
     *
     * @var string|null
     */
    protected ?string $method = Saloon::PUT;

    /**
     * The endpoint of the request.
     *
     * @return string
     */
    public function defineEndpoint(): string
    {
        return '/' . $this->id;
    }

    /**
     * @param string $id
     */
    public function __construct(
        public string $id,
    )
    {}
}
