<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnsemblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensembles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('school_id')->constrained();
            $table->string('name', 40);
            $table->string('abbr', 8);
            $table->text('descr')->nullable();
            $table->foreignId('ensembletype_id')->default(1);
            $table->integer('startyear')->default(1980);
            $table->integer('endyear')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['school_id', 'user_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ensembles');
    }
}
