<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rate extends Model
{
    public function penalties(): HasMany
    {
        return $this->hasMany(Penalty::class);
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }
}
