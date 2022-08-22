<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEapplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eapplications', function (Blueprint $table) {
            $table->foreignId('registrant_id')->constrained()->primary();
            $table->foreignId('eventversion_id')->constrained();
            $table->boolean('eligibility')->default(0);
            $table->boolean('rulesandregs')->default(0);
            $table->boolean('imageuse')->default(0);
            $table->boolean('videouse')->default(0);
            $table->boolean('absences')->default(0);
            $table->boolean('lates')->default(0);
            $table->boolean('dressrehearsal')->default(0);
            $table->boolean('parentread')->default(0);
            $table->boolean('courtesy')->default(0);
            $table->boolean('signatureguardian')->default(0);
            $table->boolean('signaturestudent')->default(0);
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
        Schema::dropIfExists('eapplications');
    }
}
