<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'title' => 'Mr.',
            'email' => 'admin@gmail.com',
            'phone' => 1754758695,
            'city' => 'Mainz',
            'state' => 'Rhineland-Palatinate',
            'country' => 'Germany',
            'email_verified_at' => now(),
            'password' => '$2y$12$zk9lF4YWB4C7hZLS5Z0vhuchoFpR4xUD/YUQ.Gey.EoUmiCmKxyze', //admin@123
            'role_id' => 1
        ]);
    }
}
