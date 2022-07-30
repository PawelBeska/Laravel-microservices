<?php

namespace Tests\Feature;

use App\Genre;
use App\Movie;
use App\MovieData;
use App\Tag;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @throws \Exception
     */
    public function test_the_application_returns_a_successful_response()
    {


        $tags = Tag::factory()->times(100)->create();
        $genres = Genre::factory()->times(100)->create();
        for ($x = 0; $x <= 1000; $x++) {
            $movie = Movie::factory()->create();
            $movie->data()->save(MovieData::factory([
                'key' => "year",
                'value' => random_int(1900, 2020)
            ])->make());

            $movie->tags()->attach($tags->random(random_int(1, 10)));
            $movie->genre()->attach($genres->random(random_int(1, 10)));

        }


    }
}
