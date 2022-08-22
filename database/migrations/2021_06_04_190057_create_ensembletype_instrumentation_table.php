<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnsembletypeInstrumentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensembletype_instrumentation', function (Blueprint $table) {
            $table->foreignId('ensembletype_id')->constrained();
            $table->foreignId('instrumentation_id')->constrained();
            $table->integer('order_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ensembletype_instrumentation');
    }
}
