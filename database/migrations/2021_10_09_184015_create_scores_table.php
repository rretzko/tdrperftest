<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained();
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('user_id')->comment('adjucdicator')->constrained();
            $table->foreignId('scoringcomponent_id')->constrained();
            $table->tinyInteger('score');
            $table->unsignedBigInteger('proxy_id')->comment('user acting as judge');
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
        Schema::dropIfExists('scores');
    }
}
