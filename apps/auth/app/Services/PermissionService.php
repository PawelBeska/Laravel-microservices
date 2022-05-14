<?php

namespace App\Services;

use App\Models\Permission;

class PermissionService
{

    public function __construct(private Permission $permission = new Permission())
    {

    }

    /**
     * @return \App\Models\Permission
     */
    public function getPermission(): Permission
    {
        return $this->permission;
    }

    /**
     * @param string $name
     * @param string $description
     * @return $this
     */
    public function assignData(
        string $name,
        string $description
    ): static
    {
        $this->permission->name = $name;
        $this->permission->description = $description;
        $this->permission->save();
        return $this;
    }
}
