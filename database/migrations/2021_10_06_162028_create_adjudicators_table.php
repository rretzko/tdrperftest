<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjudicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjudicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('adjudicatorstatustype_id')->default(1)->constrained();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['room_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjudicators');
    }
}
