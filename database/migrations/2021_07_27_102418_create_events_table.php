<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('short_name', 30);
            $table->foreignId('organization_id')->constrained();
            $table->unsignedSmallInteger('auditioncount');
            $table->string('frequency')->default('annual');
            $table->string('grades', 24)->default('9,10,11,12');
            $table->string('status')->default('active');
            $table->unsignedSmallInteger('first_event');
            $table->string('logo_file')->nullable();
            $table->string('logo_file_alt')->nullable();
            $table->boolean('requiredheight')->default(0);
            $table->boolean('requiredshirtsize')->default(0);
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
        Schema::dropIfExists('events');
    }
}
