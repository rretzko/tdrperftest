<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompositioncollectiontypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compositioncollectiontypes', function (Blueprint $table) {
            $table->id();
            $table->string('media');
            $table->string('descr');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['media','descr']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compositioncollectiontypes');
    }
}
