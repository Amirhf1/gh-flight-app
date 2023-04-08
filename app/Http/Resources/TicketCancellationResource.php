<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketCancellationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'tax_amount' => $this->resource,
        ];
    }
}
