<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditionstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditionstatuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained();
            $table->foreignId('eventversion_id')->constrained();
            $table->unsignedBigInteger('room_id')->default(0);
            $table->foreignId('auditionstatustype_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditionstatuses');
    }
}
