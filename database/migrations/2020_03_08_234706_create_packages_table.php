<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('packages', function (Blueprint $table){
            $table->id();
            $table->string('title');
            $table->text('description')->nullable()->default(null);
            $table->string('key', 32)->unique();
            $table->string('password')->nullable()->default(null);
            $table->bigInteger('sender_id')->unsigned();
            $table->bigInteger('recipient_id')->unsigned();
            $table->boolean('new')->default(true);
            $table->boolean('directLink')->default(false);
            $table->timestamp('expires_at')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('packages');
    }
}
