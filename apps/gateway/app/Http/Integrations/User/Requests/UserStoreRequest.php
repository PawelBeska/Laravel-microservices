<?php

namespace App\Http\Integrations\User\Requests;

use App\Http\Integrations\User\UserConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class UserStoreRequest extends SaloonRequest
{
    use HasJsonBody;
    /**
     * The connector class.
     *
     * @var string|null
     */
    protected ?string $connector = UserConnector::class;

    /**
     * The HTTP verb the request will use.
     *
     * @var string|null
     */
    protected ?string $method = Saloon::POST;

}
