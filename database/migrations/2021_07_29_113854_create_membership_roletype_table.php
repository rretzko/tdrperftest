<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipRoletypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_roletype', function (Blueprint $table) {
            $table->foreignId('membership_id')->constrained();
            $table->foreignId('roletype_id')->constrained();
            $table->timestamps();
            $table->primary(['membership_id', 'roletype_id',]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_roletype');
    }
}
