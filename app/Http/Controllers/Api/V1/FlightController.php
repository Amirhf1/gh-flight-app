<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CancelTicketRequest;
use App\Http\Resources\TicketCancellationResource;
use App\Models\Airline;
use App\Services\FlightService;
use App\Services\Penaltys\OtherPenalty;
use App\Services\Penaltys\PenaltyCalculator;
use App\Services\Penaltys\SahaPenalty;
use Carbon\Carbon;

class FlightController extends Controller
{
    /**
     * @throws \Exception
     */
    public function cancelTicket(CancelTicketRequest $request)
    {
        $airline = Airline::findOrFail($request['airline_id']);
        $rate = $airline->rates()->findOrFail($request['rate_id']);

        // dd($airline, $rate);

        $flightService = FlightService::ready(
            $request['ticket_price'],
            $request['departure_time'],
            $rate,
            $airline
        );

        return new TicketCancellationResource($this->taxAmount($flightService, Carbon::parse($request['cancellation_time'])));
    }

    public function cancelTicketDatabase()
    {
        $saha = new SahaPenalty();
        // you can call other penalty's.


        return json_encode($saha->penaltyCalculator('Y', '2023-01-01 20:00:00'));
    }

    /**
     * @throws \Exception
     */
    public function taxAmount(FlightService $flightService, Carbon $cancellation_time)
    {
        return $flightService
            ->build()
            ->calculateTax(Carbon::parse($cancellation_time)); // return float
    }
}
