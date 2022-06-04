<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    use WithFaker;

    /**
     * @return void
     */
    public function test_login_when_user_is_not_active(): void
    {
        $email = $this->faker->email;
        (new UserService())->assignData(
            $this->faker->name,
            $email,
            "123456"
        );
        $response = $this->post('/api/v1/login', [
            'email' => $email,
            'password' => "123456"
        ]);


        $response->assertStatus(400);
        $response->assertJsonStructure(
            [
                "status",
                "message",
                "code"
            ]
        );
    }
    /**
     * @return void
     */
    public function test_login_when_user_is_active(): void
    {
        $email = $this->faker->email;
        (new UserService())->assignData(
            $this->faker->name,
            $email,
            "123456",
            now()
        );
        $response = $this->post('/api/v1/login', [
            'email' => $email,
            'password' => "123456"
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                "status",
                "code",
                "data" => [
                    "user" => [
                        "id",
                        "name",
                        "email",
                        "active",
                        "role",
                    ],
                    "access_token"
                ],
            ]
        );
    }


    /**
     * @return void
     */
    public function test_register(): void
    {
        $email = $this->faker->email;
        $password = $this->faker->password;
        $response = $this->post('/api/v1/register', [
            'name' => $this->faker->name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "id",
                "name",
                "email",
                "active",
                "role",
            ],
            "status",
            "code",
        ]);
    }

    /**
     * @return void
     */
    public function test_logout(): void
    {
        $user = (new UserService())->assignData(
            $this->faker->name,
            $this->faker->email,
            "123456",
            now()
        )->getUser();
        $this->actingAs($user, 'api');
        $response = $this->get('/api/v1/logout');
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                "status",
                "data",
                "code"
            ]
        );
    }
}
