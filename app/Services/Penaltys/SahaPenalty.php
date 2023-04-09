<?php

namespace App\Services\Penaltys;

use App\Http\Interfaces\PenaltyInterface;
use Illuminate\Support\Carbon;

class SahaPenalty implements PenaltyInterface
{
    private array $penaltyTimes = [
        'before -1 days 12:00:00' => [
            ['classes' => ['A', 'B', 'C'], 'percentage' => 0.4],
            ['classes' => ['Y', 'W'], 'percentage' => 0.3],
            ['classes' => ['K'], 'percentage' => 0.9],
            ['classes' => ['L', 'M', 'N'], 'percentage' => 0.5],
        ],
        'before -4 hours' => [
            ['classes' => ['A', 'B', 'C'], 'percentage' => 0.5],
            ['classes' => ['Y', 'W'], 'percentage' => 0.9],
            ['classes' => ['K'], 'percentage' => 0.8],
            ['classes' => ['L', 'M', 'N'], 'percentage' => 0.3],
        ],
        'after -4 hours' => [
            ['classes' => ['A', 'B', 'C'], 'percentage' => 0.2],
            ['classes' => ['Y', 'W'], 'percentage' => 0.1],
            ['classes' => ['K'], 'percentage' => 0.8],
            ['classes' => ['L', 'M', 'N'], 'percentage' => 0.4],
        ],
    ];

    public function penaltyCalculator($rate, $departure)
    {
        $class = new static();

        $cancellationTimes = [];

        foreach ($class->penaltyTimes as $penaltyTime => $bunches) {

            $cancelDate = Carbon::parse('2022-12-31 11:00:00');

            $array = explode(' ', $penaltyTime);

            $realTime = str_replace('after', '', $penaltyTime);

            $realTime = str_replace('before', '', $penaltyTime);

            $departure = Carbon::parse($departure);

            $cancellationTime = Carbon::parse(date('Y-m-d H:i:s', strtotime($realTime, $departure->timestamp)));

            if ($array[0] == 'before' && $cancelDate instanceof Carbon && $cancellationTime instanceof Carbon && $cancelDate->lte($cancellationTime)) {
                foreach ($bunches as $bunch) {
                    if (in_array($rate, $bunch['classes'])) {
                    return $bunch['percentage'];
                    }
                }
            }

            if ($array[0] == 'after' && $cancelDate instanceof Carbon && $cancellationTime instanceof Carbon && $cancelDate->gt($cancellationTime)) {
                foreach ($bunches as $bunch) {
                    if (in_array($rate, $bunch['classes'])) {
                    return $bunch['percentage'];
                    }
                }
            }
        }

        return $cancellationTimes;
    }
}
