<?php

namespace App\Http\Integrations\Permission\Requests;

use App\Http\Integrations\Permission\PermissionConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;

class PermissionIndexRequest extends SaloonRequest
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
    protected ?string $method = Saloon::GET;

}
