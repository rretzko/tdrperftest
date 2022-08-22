<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventversionFilecontenttypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventversion_filecontenttype', function (Blueprint $table) {
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('filecontenttype_id')->constrainer();
            $table->string('title')->nullable();
            $table->timestamps();
            $table->primary(['eventversion_id','filecontenttype_id'], 'evid_fctid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventversion_filecontenttype');
    }
}
