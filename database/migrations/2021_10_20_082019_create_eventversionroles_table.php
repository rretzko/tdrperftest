<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventversionrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventversionroles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('membership_id')->constrained();
            $table->foreignId('roletype_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['eventversion_id','user_id','roletype_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventversionroles');
    }
}
