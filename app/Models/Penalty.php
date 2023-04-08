<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }
}
