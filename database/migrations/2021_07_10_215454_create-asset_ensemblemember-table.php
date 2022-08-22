<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetEnsemblememberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_ensemblemember', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('asset_id')->constrained();
            $table->foreignId('ensemblemember_id')->constrained();
            $table->string('tag',40);
            $table->dateTime('date_issued')->nullable();
            $table->dateTime('date_returned')->nullable();
            $table->timestamps();
            $table->unique(['asset_id', 'ensemblemember_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_ensemblemember');
    }
}
