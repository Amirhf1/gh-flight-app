<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('airline_id')
                ->constrained('airlines')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('rate_id')
                ->constrained('rates')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('time');
            $table->float('penalty_percentage');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penalties');
    }
};
