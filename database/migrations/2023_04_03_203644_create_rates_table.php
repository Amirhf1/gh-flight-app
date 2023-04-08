<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')
                ->constrained('airlines')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('class_name')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rates');
    }
};
