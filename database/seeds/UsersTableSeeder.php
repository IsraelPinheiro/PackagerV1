<?php

use Illuminate\Database\Seeder;
use App\User as User;

class UsersTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('users')->truncate();
        
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@procaudit.com.br',
            'password' => Hash::make('admin'),
            'profile_id' => 1,
            'created_by' => 1
        ]);
        $this->command->info('Usuário Adminsitrador Criado');
    }
}
