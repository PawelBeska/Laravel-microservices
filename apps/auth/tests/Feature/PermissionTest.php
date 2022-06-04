<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Services\PermissionService;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermissionTest extends TestCase
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
                $q->where('name', 'LIKE', 'permission.%');
            })->first()
        )->getUser();
        $this->actingAs($this->user, 'api');
    }

    /**
     * @return void
     */
    public function test_get_all_permissions(): void
    {
        $response = $this->get('/api/v1/permission');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "data" => [
                    [
                        "id",
                        "name",
                        "description"
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
    public function test_show_permission(): void
    {

        $permission = (new PermissionService())->assignData(
            $this->faker->name,
            $this->faker->text
        )->getPermission();
        $response = $this->get('/api/v1/permission/' . $permission->id);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                "status",
                "data" => [
                    "id",
                    "name",
                    "description",
                ],
                "code"
            ]
        );
    }

    /**
     * @return void
     */
    public function test_update_permission(): void
    {
        $name = $this->faker->name;
        $permission = (new PermissionService())->assignData(
            $this->faker->name,
            $this->faker->text
        )->getPermission();
        $response = $this->put('/api/v1/permission/' . $permission->id, [
            'name' => $name,
            'description' => "test_description",
        ]);


        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "id",
                "name",
                "description"
            ],
            "code"
        ]);
        $this->assertDatabaseHas(Permission::class,
            [
                "name" => $name,
                "description" => "test_description"
            ]);
    }

    /**
     * @return void
     */
    public function test_store_permission(): void
    {
        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
        $response = $this->post('/api/v1/permission', $data);

        ray()->green()->json($response->getContent());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "id",
                "name",
                "description"
            ],
            "code"
        ]);
        $this->assertDatabaseHas(Permission::class, $data);
    }
}
