<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'password' => bcrypt('admin12345678'),
            'api_token' => Str::random(80),
            'role' => 'admin',
        ]);
    }
}
