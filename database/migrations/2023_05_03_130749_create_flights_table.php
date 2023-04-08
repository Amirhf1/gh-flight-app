<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rate_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('airline_id')->constrained('airlines')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('time_canceled');
            $table->dateTime('fly_time');
            $table->float('ticket_price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
};
