<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminreviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminreviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained();
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('user_id')->comments('Reviewer')->constrained();
            $table->boolean('reviewed');
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
        Schema::dropIfExists('adminreviews');
    }
}
