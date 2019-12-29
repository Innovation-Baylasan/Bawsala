<?php

use App\User;
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
        User::create([
            'name' => 'Baylsaan Admin',
            'email' => 'admin@baylsaan.com',
            'username' => User::generateUsername('Baylsaan Admin'),
            'password' => bcrypt('admin12345678'),
            'role_id' => '1',
        ]);
    }
}
