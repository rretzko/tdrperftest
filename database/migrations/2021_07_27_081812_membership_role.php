<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MembershipRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_role', function (Blueprint $table) {
            $table->foreignId('membership_id')->constrained();
            $table->foreignId('role_id')->constrained();
            $table->timestamps();
            $table->unique(['membership_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_role');
    }
}
