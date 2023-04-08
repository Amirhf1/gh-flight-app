<?php

namespace App\Services;

use App\Models\Airline;

class AirlineService
{
    public function index()
    {
        return Airline::query()->get();
    }
}
