<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'firstname' => 'Admin',
            'lastname' => 'Tennisvereniging',
            'email' => 'admin@tennisvereniging.nl',
            'password' => Hash::make('admin'),
            'roles_id' => 1,
        ]);
        DB::table('users')->insert([
            'firstname' => 'Gedelegeerd',
            'lastname' => 'Lid',
            'email' => 'gedelegeerd@tennisvereniging.nl',
            'password' => Hash::make('admin'),
            'member' => '12345678',
            'roles_id' => 2,
        ]);
        DB::table('users')->insert([
            'firstname' => 'lid',
            'lastname' => 'Tennisvereniging',
            'email' => 'lid@tennisvereniging.nl',
            'password' => Hash::make('admin'),
            'member' => '87654321',
            'roles_id' => 3,
        ]);
    }
}
