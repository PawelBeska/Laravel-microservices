<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Services\PermissionService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use WithFaker;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = (new UserService())->assignData(
            $this->faker->name,
            $this->faker->email,
            "123456",
            now(),
            Role::whereHas('permissions', function ($q) {
                $q->where('name', 'LIKE', 'role.%');
            })->first()
        )->getUser();
        $this->actingAs($this->user, 'api');
    }

    /**
     * @return void
     */
    public function test_get_all_roles(): void
    {
        $response = $this->get('/api/v1/role');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "data" => [
                    [
                        "id",
                        "name",
                        "permissions" => []
                    ]
                ],
                "pagination" => [
                    "total",
                    "count",
                    "per_page",
                    "current_page",
                    "total_pages",
                ]
            ],
            "code"
        ]);
    }

    /**
     * @return void
     */
    public function test_show_role(): void
    {

        $role = (new RoleService())->assignData(
            $this->faker->name,
            Permission::where('name', 'LIKE', 'role.%')->pluck('id')->toArray()
        )->getRole();
        $response = $this->get('/api/v1/role/' . $role->id);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                "status",
                "data" => [
                    "id",
                    "name",
                    "permissions" => []
                ],
                "code"
            ]
        );
    }

    /**
     * @return void
     */
    public function test_update_role(): void
    {
        $name = $this->faker->name;
        $role = (new RoleService())->assignData(
            $this->faker->name,
            Permission::where('name', 'LIKE', 'role.%')->pluck('id')->toArray()
        )->getRole();
        $response = $this->put('/api/v1/role/' . $role->id, [
            'name' => $name,
        ]);


        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "id",
                "name",
                'permissions' => []
            ],
            "code"
        ]);
        $this->assertDatabaseHas(Role::class,
            [
                "name" => $name,
            ]);
    }

    /**
     * @return void
     */
    public function test_store_role_without_permissions(): void
    {
        $data = [
            'name' => $this->faker->name,
        ];
        $response = $this->post('/api/v1/role', $data);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "id",
                "name",
                'permissions' => []
            ],
            "code"
        ]);
        $this->assertDatabaseHas(Role::class, $data);
    }


    /**
     * @return void
     */
    public function test_store_role_with_permissions(): void
    {
        $data = [
            'name' => $this->faker->name,
        ];
        $response = $this->post('/api/v1/role',
            [
                'name' => $data['name'],
                'permissions' => Permission::where('name', 'LIKE', 'role.%')->pluck('id')->toArray()
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "id",
                "name",
                'permissions' => []
            ],
            "code"
        ]);
        $this->assertDatabaseHas(Role::class, $data);
    }

    /**
     * @return void
     */
    public function test_delete_role(): void
    {
        $data = [
            'name' => $this->faker->name,
        ];
        $role = (new RoleService())->assignData(
            $data['name'],
            Permission::where('name', 'LIKE', 'role.%')->pluck('id')->toArray()
        )->getRole();
        $response = $this->delete('/api/v1/role/' . $role->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data",
            "code"
        ]);
        $this->assertDatabaseMissing(Role::class, $data);
    }
}
