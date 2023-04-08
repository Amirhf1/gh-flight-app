<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string airline_name
 * @property string rate_id
 * @property \DateTime time_canceled
 * @property \DateTime fly_time
 * @property float ticket_price
 * @property int airline_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 *
 * */
class Flight extends Model
{
    use HasFactory;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAirlineName(): string
    {
        return $this->airline_name;
    }

    public function setAirlineName(string $airline_name): void
    {
        $this->airline_name = $airline_name;
    }

    public function getRateId(): string
    {
        return $this->rate_id;
    }

    public function setRateId(string $rate_id): void
    {
        $this->rate_id = $rate_id;
    }

    public function getTimeCanceled(): \DateTime
    {
        return $this->time_canceled;
    }

    public function setTimeCanceled(\DateTime $time_canceled): void
    {
        $this->time_canceled = $time_canceled;
    }

    public function getFlyTime(): \DateTime
    {
        return $this->fly_time;
    }

    public function setFlyTime(\DateTime $fly_time): void
    {
        $this->fly_time = $fly_time;
    }

    public function getTicketPrice(): float
    {
        return $this->ticket_price;
    }

    public function setTicketPrice(float $ticket_price): void
    {
        $this->ticket_price = $ticket_price;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    public function rate(): BelongsTo
    {
        return $this->belongsTo(Rate::class);
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function getAirlineId(): int
    {
        return $this->airline_id;
    }

    public function setAirlineId(int $airline_id): void
    {
        $this->airline_id = $airline_id;
    }
}
