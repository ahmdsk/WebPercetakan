<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'ahmad',
            'email'     => 'ahmad@tes.com',
            'password'  => bcrypt('12345678'),
            'role'      => 'admin',
            'no_telp'   => '08122345678'
        ]);
        DB::table('users')->insert([
            'name'      => 'member',
            'email'     => 'member@tes.com',
            'password'  => bcrypt('12345678'),
            'role'      => 'user',
            'no_telp'   => '0823456789'
        ]);
    }
}
