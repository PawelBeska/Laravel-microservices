<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminNotificationTemplatesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notification_templates_read = (new PermissionService())->assignData('notification_templates.read', 'Read notification templates permission')->getPermission();
        $notification_templates_create = (new PermissionService())->assignData('notification_templates.create', 'Create notification templates permission')->getPermission();
        $notification_templates_update = (new PermissionService())->assignData('notification_templates.update', 'Update notification templates permission')->getPermission();
        $notification_templates_delete = (new PermissionService())->assignData('notification_templates.delete', 'Delete notification templates permission')->getPermission();

        $role = Role::whereHas('permissions', function ($q) {
            $q->where('name', 'admin');
        })->first();

        (new RoleService($role))
            ->addPermission($notification_templates_read)
            ->addPermission($notification_templates_create)
            ->addPermission($notification_templates_update)
            ->addPermission($notification_templates_delete);
    }
}
