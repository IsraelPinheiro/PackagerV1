<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Factory;
use App\Profile as Profile;

class ProfilesTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //Administrator Profile 
        DB::table('profiles')->truncate();
        Profile::create([
            'name' => 'Administrador',
            'description' => 'Perfil padrão de administrador do sistema',
            
            'acl_users' => '{"create":true, "read":true, "update":true, "delete":true}',
            'acl_profiles' => '{"create":true, "read":true, "update":true, "delete":true}',
            'acl_backups' => '{"create":true, "read":true, "restore":true, "delete":true}',
            'acl_backups_schedules' =>   '{"create":true, "read":true, "update":true, "delete":true}',
            'acl_audit_accessLogs' =>    '{"read":true, "download":true}',
            'acl_audit_changeLogs' =>    '{"read":true, "download":true, "restore":true}',

            'created_by' => 1
        ]);
        $this->command->info('Administrator Profile Created');

        if(app()->environment('local')){
            
        }
    }
}
