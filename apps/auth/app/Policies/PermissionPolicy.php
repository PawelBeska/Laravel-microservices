<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(
            'permission.view'
        );
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Permission $permission
     * @return bool
     */
    public function view(User $user, Permission $permission): bool
    {
        return $user->hasPermission(
            'permission.view'
        );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(
            'permission.create'
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Permission $permission
     * @return bool
     */
    public function update(User $user, Permission $permission): bool
    {
        return $user->hasPermission(
            'permission.update'
        );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Permission $permission
     * @return bool
     */
    public function delete(User $user, Permission $permission): bool
    {
        return $user->hasPermission(
            'permission.delete'
        );
    }


}
