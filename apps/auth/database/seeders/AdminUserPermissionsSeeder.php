<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Database\Seeder;

class AdminUserPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_read = (new PermissionService())->assignData('user.read', 'Read users permission')->getPermission();
        $user_create = (new PermissionService())->assignData('user.create', 'Create users permission')->getPermission();
        $user_update = (new PermissionService())->assignData('user.update', 'Update users permission')->getPermission();
        $user_delete = (new PermissionService())->assignData('user.delete', 'Delete users permission')->getPermission();

        $role = Role::whereHas('permissions', function ($q) {
            $q->where('name', 'admin');
        })->first();

        (new RoleService($role))
            ->addPermission($user_read)
            ->addPermission($user_create)
            ->addPermission($user_update)
            ->addPermission($user_delete);

    }
}
