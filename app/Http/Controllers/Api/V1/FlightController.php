<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CancelTicketRequest;
use App\Http\Resources\TicketCancellationResource;
use App\Models\Airline;
use App\Services\FlightService;
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

    /**
     * @throws \Exception
     */
    public function cancelTicketDatabase()
    {

        $airlineId = Airline::findOrFail(1);
        $rateId = $airlineId->rates()->findOrFail(1);
        $ticket_price = 1000;
        $departure_time = Carbon::parse('2023-04-04 17:30:00.000');
        $cancellation_time = now()->format('Y-m-d H:i:s');

        $flightService = FlightService::ready(
            $ticket_price,
            $departure_time,
            $rateId,
            $airlineId,
        );

        return new TicketCancellationResource($this->taxAmount($flightService, Carbon::parse($cancellation_time)));
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
