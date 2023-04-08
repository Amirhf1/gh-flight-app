<?php

use App\Http\Controllers\Api\V1\AirlineController;
use App\Http\Controllers\Api\V1\FlightController;
use App\Http\Controllers\Api\V1\RateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// result
Route::post('flights/cancel', [FlightController::class, 'cancelTicket']); // with database
Route::get('flights/cancel-db', [FlightController::class, 'cancelTicketDatabase']); // with parameters

// rate
Route::get('rate/list', [RateController::class, 'index']);

// airline
Route::get('airline/list', [AirlineController::class, 'index']);
