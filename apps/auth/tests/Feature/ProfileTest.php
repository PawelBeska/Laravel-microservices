<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
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
    public function test_get_profile()
    {
        $response = $this->get('/api/v1/profile');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "id",
                "name",
                "email",
                "active",
                "role" => [
                    "id",
                    "name",
                    "permissions" => []
                ]
            ],
            "code"
        ]);
    }
}
