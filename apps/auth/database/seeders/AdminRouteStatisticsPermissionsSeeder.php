<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminRouteStatisticsPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $route_statistics_read = (new PermissionService())->assignData('route_statistics.read', 'Read route statistics permission')->getPermission();
        $route_statistics_create = (new PermissionService())->assignData('route_statistics.create', 'Create route statistics permission')->getPermission();
        $route_statistics_update = (new PermissionService())->assignData('route_statistics.update', 'Update route statistics permission')->getPermission();
        $route_statistics_delete = (new PermissionService())->assignData('route_statistics.delete', 'Delete route statistics permission')->getPermission();

        $role = Role::whereHas('permissions', function ($q) {
            $q->where('name', 'admin');
        })->first();

        (new RoleService($role))
            ->addPermission($route_statistics_read)
            ->addPermission($route_statistics_create)
            ->addPermission($route_statistics_update)
            ->addPermission($route_statistics_delete);
    }
}
