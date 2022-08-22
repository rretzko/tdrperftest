<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePronounsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pronouns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descr', 60);
            $table->string('intensive',60);
            $table->string('personal',60);
            $table->string('possessive',60);
            $table->string('object',60);
            $table->smallInteger('order_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pronouns');
    }
}
