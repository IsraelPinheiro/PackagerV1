<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessLogsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('access_logs', function (Blueprint $table){
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->ipAddress('origin');
            $table->timestamp('accessed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('access_logs');
    }
}
