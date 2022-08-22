<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventensemblecutoffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventensemblecutoffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('eventensemble_id')->constrained();
            $table->foreignId('instrumentation_id')->constrained();
            $table->float('cutoff',5,2)->default(0);
            $table->foreignId('user_id')->comment('updating user')->constrained();
            $table->timestamps();
            $table->unique(['eventversion_id','eventensemble_id', 'instrumentation_id'],'version_ensemble_instrumentation_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventensemblecutoffs');
    }
}
