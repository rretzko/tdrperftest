<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumentation_user', function (Blueprint $table) {
            $table->foreignId('instrumentation_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->tinyInteger('order_by')->default(1);
            $table->timestamps();
            $table->primary(['instrumentation_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instrumentation_user');
    }
}
