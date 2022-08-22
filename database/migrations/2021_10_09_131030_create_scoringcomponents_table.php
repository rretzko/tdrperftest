<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoringcomponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoringcomponents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('filecontenttype_id')->constrained();
            $table->string('descr', 60);
            $table->string('abbr', 8);
            $table->tinyInteger('bestscore');
            $table->tinyInteger('worstscore');
            $table->tinyInteger('interval');
            $table->tinyInteger('tolerance');
            $table->tinyInteger('order_by');
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
        Schema::dropIfExists('scoringcomponents');
    }
}
