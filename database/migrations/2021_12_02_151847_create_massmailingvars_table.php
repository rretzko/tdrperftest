<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassmailingvarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massmailingvars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('massmailing_id')->constrained();
            $table->text('descr', 40);
            $table->text('var');
            $table->integer('order_by')->default(1);
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
        Schema::dropIfExists('massmailingvars');
    }
}
