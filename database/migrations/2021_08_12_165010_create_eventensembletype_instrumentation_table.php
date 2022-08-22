<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventensembletypeInstrumentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventensembletype_instrumentation', function (Blueprint $table) {
            $table->foreignId('eventensembletype_id')->constrained();
            $table->foreignId('instrumentation_id')->constrained();
            $table->smallInteger('order_by')->default(1);
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
        Schema::dropIfExists('eventensembletype_instrumentation');
    }
}
