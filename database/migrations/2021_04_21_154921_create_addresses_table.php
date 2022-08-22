<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->primary();
            $table->text('address01')->nullable(); //encrypted value
            $table->text('address02')->nullable(); //encrypted value
            $table->text('city')->nullable(); //encrypted value
            $table->foreignId('geostate_id')->default(37)->constrained();
            $table->text('postalcode')->nullable(); //encrypted value
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
        Schema::dropIfExists('addresses');
    }
}
