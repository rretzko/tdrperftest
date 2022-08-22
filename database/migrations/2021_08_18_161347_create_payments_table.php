<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('registrant_id')->nullable()->constrained();
            $table->foreignId('eventversion_id')->nullable()->constrained();
            $table->foreignId('paymenttype_id')->constrained();
            $table->foreignId('school_id')->nullable()->constrained();
            $table->string('vendor_id')->nullable();
            $table->decimal('amount');
            $table->unsignedBigInteger('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('payments');
    }
}
