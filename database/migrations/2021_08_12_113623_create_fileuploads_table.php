<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileuploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileuploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained();
            $table->foreignId('filecontenttype_id')->constrained();
            $table->string('server_id');
            $table->string('folder_id')->default('none');
            $table->foreignId('uploaded_by')->nullable()->references('id')->on('users');
            $table->dateTime('approved')->nullable();
            $table->foreignId('approved_by')->nullable()->references('id')->on('users');
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
        Schema::dropIfExists('fileuploads');
    }
}
