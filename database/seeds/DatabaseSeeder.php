<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call(ProfilesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        if(app()->environment('local')){
            $this->call(FakeUsersTableSeeder::class);
        }
        if(app()->environment('production')){
            
        }
    }
}
