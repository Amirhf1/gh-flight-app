<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AirlineFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'status' => true,
        ];
    }
}
