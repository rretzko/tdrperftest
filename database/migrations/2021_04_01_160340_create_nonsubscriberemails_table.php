<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonsubscriberemailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nonsubscriberemails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('emailtype_id')->constrained();
            $table->longText('email'); //nonsubscriberemail are encrypted cannot be unique
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['user_id','emailtype_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nonsubscriberemails');
    }
}
