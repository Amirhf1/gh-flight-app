<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\Flight;
use App\Models\Rate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $alphabets = ['A', 'B', 'C', 'D', 'E'];

        Airline::factory()->count(5)->create();

        foreach ($alphabets as $alphabet) {
            Rate::create([
                'airline_id' => 1,
                'class_name' => $alphabet,
            ]);
        }

        Flight::factory()->count(5)->create();
    }
}
