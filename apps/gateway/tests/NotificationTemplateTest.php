<?php

namespace Tests;

use App\Models\Role;
use App\Services\UserService;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{


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
     * A basic test example.
     *
     * @return void
     */
    public function test_that_base_endpoint_returns_a_successful_response()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
}
