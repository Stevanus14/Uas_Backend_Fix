<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
<<<<<<< HEAD
            'name' => 'admin01',
            'email' => 'admin01@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => '$2b$10$c0W/Y0e7lBEwFgwODxpf6ussA1EPn6ihUs1MckXzIEC8uQRIjQJoG',
            'alamat' => 'admin01-alamat',
            'no_telp' => '0857913610000',
            'remember_token' => '1',
=======
            'name' => 'Stevanus Tetuko Kristianto',
            'email' => '10167@students.uajy.ac.id',
            'password' => '$2b$10$cLi8hqE.3e0p1BXuQUtSI.06x55XyRk5CfwyABawEVP3CuJ7Msbm6',
            'alamat' => 'Surakarta',
            'no_telp' => '081254764903',
>>>>>>> ab1b55d0aaeb56aef94b337ce52fe8f615f0f896
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
