<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CancelTicketException extends Exception
{
    public function render($message): JsonResponse
    {
        return Response()->json($message);
    }
}
