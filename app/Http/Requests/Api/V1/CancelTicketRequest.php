<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class CancelTicketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rate_id' => 'required|integer',
            'cancellation_time' => 'date',
            'ticket_price' => 'required|decimal:0,99.99',
            'departure_time' => 'required|date',
            'airline_id' => 'required|exists:airlines,id',
        ];
    }
}
