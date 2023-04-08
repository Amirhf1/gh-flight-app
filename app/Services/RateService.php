<?php

namespace App\Services;

use App\Models\Rate;

class RateService
{
    public function index()
    {
        return Rate::query()->get();
    }
}
