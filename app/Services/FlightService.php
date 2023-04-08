<?php

namespace App\Services;

use App\Exceptions\CancelTicketException;
use App\Models\Airline;
use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Support\Str;

class FlightService
{
    public $price;

    public $departureAt;

    public $penalties;

    public $rate;

    public $airline;

    public static function ready($price, $departureAt, Rate $rate, Airline $airline): static
    {
        return (new static)
            ->setPrice($price)
            ->setDepartureAt($departureAt)
            ->setRate($rate)
            ->setPenalties($rate->penalties)
            ->setAirline($airline);
    }

    public function build(): static
    {
        $departureTime = Carbon::parse($this->departureAt);
        $penalties = $this->penalties;
        $beforePenalties = [];
        $afterPenalties = [];

        foreach ($penalties as $penalty) {
            $penaltyTime = Carbon::parse($departureTime
                    ->format('Y-m-d').' '.str_replace(['before ', 'after '], '', $penalty->time));

            if (Str::startsWith($penalty->time, 'before')) {
                $beforePenalties[] = [$penaltyTime, $penalty->penalty_percentage];
            } else {
                $afterPenalties[] = [$penaltyTime, $penalty->penalty_percentage];
            }
        }

        $newPenalties = [
            'before' => $beforePenalties,
            'after' => $afterPenalties,
        ];

        usort($newPenalties['after'], fn ($a, $b) => $b[0] <=> $a[0]);
        usort($newPenalties['before'], fn ($a, $b) => $a[0] <=> $b[0]);

        $this->setPenalties($newPenalties);

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function calculateTax(Carbon $cancellationTime): float
    {
        foreach ($this->penalties as $penaltyType => $penaltyTimes) {
            foreach ($penaltyTimes as $penalty) {
                $penaltyTime = Carbon::parse($penalty[0]);
                if (($penaltyType === 'before' && $cancellationTime->lte($penaltyTime)) ||
                    ($penaltyType === 'after' && $cancellationTime->gte($penaltyTime))) {
                    return (float) $penalty[1];
                }
            }
        }

        throw new CancelTicketException('No penalty found for the given cancellation time.');
    }

    public function sortHighest($a, $b): int
    {
        return strtotime($b[0]) <=> strtotime($a[0]);
    }

    public function sortLowest($a, $b): int
    {
        return strtotime($a[0]) <=> strtotime($b[0]);
    }

    private function setPrice($price): static
    {
        $this->price = $price;

        return $this;
    }

    private function setDepartureAt($departureAt): static
    {
        $this->departureAt = $departureAt;

        return $this;
    }

    private function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    private function setPenalties($penalties)
    {
        $this->penalties = $penalties;

        return $this;
    }

    private function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getAirline()
    {
        return $this->airline;
    }

    public function setAirline($airline): static
    {
        $this->airline = $airline;

        return $this;
    }

    private function getDepartureAt()
    {
        return $this->departureAt;
    }
}
