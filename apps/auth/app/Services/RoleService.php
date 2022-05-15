<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;

class RoleService
{

    public function __construct(private Role $role = new Role())
    {

    }

    /**
     * @return \App\Models\Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param string $name
     * @param array $permissions
     * @return $this
     */
    public function assignData(
        string $name,
        array  $permissions = []
    ): static
    {
        $this->role->name = $name;
        if ($permissions) {
            $this->role->permissions()->sync($permissions);
        }
        $this->role->save();
        return $this;
    }

    /**
     * @param \App\Models\Permission $permission
     * @return $this
     */
    public function addPermission(Permission $permission): static
    {
        $this->role->permissions()->syncWithoutDetaching($permission);
        return $this;
    }
}
