<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventversionconfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventversionconfigs', function (Blueprint $table) {
            $table->foreignId('eventversion_id')->primary();
            $table->boolean('paypalteacher')->default(0);
            $table->boolean('paypalstudent')->default(0);
            $table->float('registrationfee')->default(0);
            $table->string('grades')->default('9,10,11,12');
            $table->boolean('eapplication')->default(0);
            $table->tinyInteger('judge_count')->default(1);
            $table->tinyInteger('max_count')->default(30);
            $table->tinyInteger('max-uppervoice_count')->default(0);
            $table->boolean('missing_judge_average')->default(1);
            $table->boolean('epaymentsurcharge')->default(0);
            $table->boolean('virtualaudition')->default(0);
            $table->boolean('audiofiles')->default(0);
            $table->boolean('videofiles')->default(0);
            /* mysql */
            //$table->set('bestscore',['asc','desc'])->default('desc');
            /* postgreSql */
            $table->enum('bestscore',['asc','desc'])->default('desc');
            $table->tinyInteger('membershipcard')->default(1);  //0,1,2
            $table->tinyInteger('instrumentation_count')->default(1);
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
        Schema::dropIfExists('eventversionconfigs');
    }
}
