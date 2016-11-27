<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'username'  => 'admin',
            'fullname'  => 'administrador',
            'role'  => 'A',
            'email'  => 'ramses.cr02@gmail.com',
            'password'  => \Hash::make('123456'),
            'active'  => '1',
            'remember_token'  => '12324f',
        ]);
        
        factory(App\User::class, 40)->create();
    }
}
