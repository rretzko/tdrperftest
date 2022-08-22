<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class
CreateFileuploadfoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileuploadfolders', function (Blueprint $table) {
            $table->id();
            $table->string('folder_id')->index();
            $table->foreignId('eventversion_id')->constrained();
            $table->foreignId('instrumentation_id')->constrained();
            $table->foreignId('filecontenttype_id')->constrained();
            $table->string('parent_id')->nullable()->comment('self-referencing column id');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('fileuploadfolders');
    }
}
