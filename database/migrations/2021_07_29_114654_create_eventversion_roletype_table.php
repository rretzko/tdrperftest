<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventversionRoletypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventversion_roletype', function (Blueprint $table) {
            $table->foreignId('membership_id')->constrained();
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('roletype_id')->constrained();
            $table->timestamps();
            $table->primary(['membership_id', 'eventversion_id', 'roletype_id'], 'mbr_ev_roletype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventversion_roletype');
    }
}
