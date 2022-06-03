<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait HasService
{
    /* @var string $name */
    public string $name = parent::class;

    /* @var int $service_version */
    public int $service_version = 1;

    /**
     * @param int|null $version
     * @return \App\Services\User\Versions\v1\UserService|\App\Services\Role\Versions\v1\RoleService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function service(int $version = null): \App\Services\User\Versions\v1\UserService|\App\Services\Role\Versions\v1\RoleService
    {

        if ($version === null) {
            $version = $this->service_version;
        }
        return app()->make("\\App\\Services\\" . parent::class . "\\Version\\v" . $version . "\\" . parent::class . "Service");
    }



}
