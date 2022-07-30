<?php

namespace Database\Factories;

use App\Enum\GenreStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->word,
            "description" => $this->faker->text,
            "status" => $this->faker->randomElement(GenreStatusEnum::cases()),
        ];
    }
}
