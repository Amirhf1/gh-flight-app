<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\AirlineService;

class AirlineController extends Controller
{
    protected AirlineService $airlineService;

    public function __construct(AirlineService $airlineService)
    {
        $this->airlineService = $airlineService;
    }

    public function index()
    {
        return $this->airlineService->index();
    }
}
