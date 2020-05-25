<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Factory;
use App\User as User;

class FakeUsersTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $faker = Factory::create('pt_BR');
        $max = rand(10, 60);
        for($i = 0; $i <= $max; $i++){
            $perfil = rand(1, 2);
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make($faker->password),
                'profile_id' => $perfil,
                'created_by' => 1
            ]);
        }
        $this->command->info($max.' Test Users created');
    }
}
