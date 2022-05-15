<?php

namespace Database\Seeders;

use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ACLseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = (new PermissionService())->assignData('user', 'Base user permission')->getPermission();
        (new RoleService())->assignData('Użytkownik')->addPermission($user);

        $admin = (new PermissionService())->assignData('admin', 'Base admin permission')->getPermission();
        $permission_read = (new PermissionService())->assignData('permission.read', 'Read permissions permission')->getPermission();
        $permission_create = (new PermissionService())->assignData('permission.create', 'Create permissions permission')->getPermission();
        $permission_update = (new PermissionService())->assignData('permission.update', 'Update permissions permission')->getPermission();
        $permission_delete = (new PermissionService())->assignData('permission.delete', 'Delete permissions permission')->getPermission();

        $role_read = (new PermissionService())->assignData('role.read', 'Read roles permission')->getPermission();
        $role_create = (new PermissionService())->assignData('role.create', 'Create roles permission')->getPermission();
        $role_update = (new PermissionService())->assignData('role.update', 'Update roles permission')->getPermission();
        $role_delete = (new PermissionService())->assignData('role.delete', 'Delete roles permission')->getPermission();

        (new RoleService())->assignData('Admin')
            ->addPermission($admin)
            ->addPermission($permission_read)
            ->addPermission($permission_create)
            ->addPermission($permission_update)
            ->addPermission($permission_delete)
            ->addPermission($role_read)
            ->addPermission($role_create)
            ->addPermission($role_update)
            ->addPermission($role_delete);

    }
}
