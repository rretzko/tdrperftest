<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventversionteacherconfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventversionteacherconfigs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('school_id')->constrained();
            $table->foreignId('eventversion_id')->constrained();
            $table->boolean('paypalstudent');
            $table->timestamps();
            $table->unique(['user_id','school_id', 'eventversion_id'], 'u_user_school_ev');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventversionteacherconfigs');
    }
}
