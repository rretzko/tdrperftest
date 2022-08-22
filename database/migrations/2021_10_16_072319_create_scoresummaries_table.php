<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoresummaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('registrant_id')->constrained();
            $table->foreignId('instrumentation_id')->constrained();
            $table->integer('score_total')->default(0);
            $table->integer('score_count')->default(0);
            $table->timestamps();
            $table->unique(['registrant_id','instrumentation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scoresummaries');
    }
}
