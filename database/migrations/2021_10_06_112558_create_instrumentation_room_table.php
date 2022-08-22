<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentationRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumentation_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instrumentation_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->timestamps();
            $table->unique(['instrumentation_id', 'room_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instrumentation_room');
    }
}
