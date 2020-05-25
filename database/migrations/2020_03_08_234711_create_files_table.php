<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('files', function (Blueprint $table){
            $table->id();
            $table->string('originalName');
            $table->bigInteger('package_id')->unsigned();
            $table->bigInteger('size')->unsigned();
            $table->string('extension');
            $table->string('file')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('files');
    }
}
