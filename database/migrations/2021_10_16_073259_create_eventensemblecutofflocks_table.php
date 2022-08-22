<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventensemblecutofflocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventensemblecutofflocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('eventensemble_id')->constrained();
            $table->tinyInteger('locked')->default(0);
            $table->foreignId('user_id')->comment('updating user')->constrained();
            $table->timestamps();
            $table->unique(['eventversion_id','eventensemble_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventensemblecutofflocks');
    }
}
