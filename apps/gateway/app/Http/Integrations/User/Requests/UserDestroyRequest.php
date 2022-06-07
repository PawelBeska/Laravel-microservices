<?php

namespace App\Http\Integrations\User\Requests;

use App\Http\Integrations\User\UserConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;

class UserDestroyRequest extends SaloonRequest
{
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
    protected ?string $method = Saloon::DELETE;

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
