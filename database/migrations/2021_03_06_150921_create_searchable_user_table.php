<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchableUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searchable_user', function (Blueprint $table) {
            $table->foreignId('searchable_id');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('searchtype_id')->constrained();
            $table->timestamps();
            $table->primary(['searchable_id', 'user_id', 'searchtype_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('searchable_user');
    }
}
