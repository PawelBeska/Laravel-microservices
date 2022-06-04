<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
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
                $q->where('name', 'LIKE', 'user.%');
            })->first()
        )->getUser();
        $this->actingAs($this->user, 'api');
    }

    /**
     * @return void
     */
    public function test_get_all_users(): void
    {
        $response = $this->get('/api/v1/user');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "data" => [
                    [
                        "id",
                        "name",
                        "email",
                        "active",
                        "role"
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
    public function test_show_user(): void
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $user = (new UserService())->assignData(
            $this->faker->name,
            $email,
            $password,
        )->getUser();
        $response = $this->get('/api/v1/user/' . $user->id);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                "status",
                "data" => [
                    "id",
                    "name",
                    "email",
                    "active",
                    "role"

                ],
                "code"
            ]
        );
    }

    /**
     * @return void
     */
    public function test_update_user(): void
    {
        $name = $this->faker->name;
        $email = $this->faker->email;

        $user = (new UserService())->assignData(
            $this->faker->name,
            $email,
            $this->faker->password,
        )->getUser();
        $response = $this->put('/api/v1/user/' . $user->id, [
            'name' => $name,
            'email' => $email,
            'role_id' => Role::first()->id
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "id",
                "name",
                "email",
                "active",
                "role"
            ],
            "code"
        ]);
        $this->assertDatabaseHas(User::class,
            [
                "name" => $name,
                "email" => $email,
            ]);
    }


    /**
     * @return void
     */
    public function test_store_user(): void
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];
        $response = $this->post('/api/v1/user',
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'password_confirmation' => $data['password'],
                'role_id' => Role::first()->id
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "id",
                "name",
                "email",
                "active",
                "role"
            ],
            "code"
        ]);
        $this->assertDatabaseHas(User::class, [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    /**
     * @return void
     */
    public function test_delete_user(): void
    {
        $email = $this->faker->email;
        $name = $this->faker->name;
        $user = (new UserService())->assignData(
            $name,
            $email,
            $this->faker->password,
        )->getUser();
        $response = $this->delete('/api/v1/user/' . $user->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data",
            "code"
        ]);
        $this->assertDatabaseMissing(User::class, [
            "name" => $name,
            "email" => $email,
        ]);
    }
}
