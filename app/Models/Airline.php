<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function flight()
    {
        return $this->hasMany(Flight::class);
    }
}
