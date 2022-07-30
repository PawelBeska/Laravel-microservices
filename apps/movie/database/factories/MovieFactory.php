<?php

namespace Database\Factories;

use App\Enum\MovieStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->word,
            "description" => $this->faker->text,
            "status" => $this->faker->randomElement(MovieStatusEnum::cases()),
        ];
    }
}
