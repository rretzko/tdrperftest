<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnsemblemembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensemblemembers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('ensemble_id')->constrained();
            $table->foreignId('schoolyear_id')->constrained();
            $table->foreignId('user_id');
            $table->foreignId('teacher_user_id')->constrained('users');
            $table->foreignId('instrumentation_id')->contrained();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['ensemble_id','schoolyear_id','user_id']);
            $table->index(['ensemble_id', 'schoolyear_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ensemblemembers');
    }
}
