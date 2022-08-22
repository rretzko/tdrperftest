<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetEnsembleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_ensemble', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('ensemble_id')->constrained();
            $table->foreignId('asset_id')->constrained();
            $table->timestamps();
            $table->unique(['ensemble_id', 'asset_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_ensemble');
    }
}
