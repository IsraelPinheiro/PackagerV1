<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call(PerfisTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
        if(app()->environment('local')){
            $this->call(FakeUsuariosTableSeeder::class);
        }
        if(app()->environment('production')){
            
        }
    }
}
