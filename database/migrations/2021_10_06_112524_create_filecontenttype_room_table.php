<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilecontenttypeRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filecontenttype_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filecontenttype_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->timestamps();
            $table->unique(['filecontenttype_id', 'room_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filecontenttype_room');
    }
}
