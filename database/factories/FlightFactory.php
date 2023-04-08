<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rate_id' => rand(1, 5),
            'airline_id' => 1,
            'ticket_price' => rand(100000, 500000),
            'fly_time' => Carbon::now()->addDays(3),
            'time_canceled' => Carbon::now()->addDay(),
        ];
    }
}
