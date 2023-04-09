<?php

namespace App\Http\Interfaces;

interface PenaltyInterface
{
    public function penaltyCalculator($rate, $departure);
}
