<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Entities\User::class)->create([
            'username' => 'admin',
            'password' => \Hash::make('123456'),    
            'email' => 'administrador@penion.com',
            'first_name'  => 'Admin',
            'last_name'  => 'Peñon',
            'type'  => 'A',
            'remember_token' => str_random(10), 
            'actived'  => '1',
        ]);
        
        factory(User::class, 40)->create();
    }
}
