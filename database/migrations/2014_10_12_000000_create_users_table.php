<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('users', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('profile_id')->unsigned();
            $table->boolean('active')->default(true);

            $table->boolean('override_storage_limits')->default(false);     //If true, the local storage limitters will be used, instead of the ones set on the user profile
            $table->bigInteger('max_file_size')->unsigned()->default(0);    //Max size (In Bytes) of a given file. A value of 0 means there is no limit
            $table->bigInteger('max_package_size')->unsigned()->default(0); //Max total size (In Bytes) of a given package. A value of 0 means there is no limit
            $table->bigInteger('max_storage_size')->unsigned()->default(0); //The storage limit of the user (In Bytes). A value of 0 means there is no limit

            $table->rememberToken();
            $table->timestamps(); //created_at e updated_at
            $table->softDeletes(); //deleted_at
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('users');
    }
}
