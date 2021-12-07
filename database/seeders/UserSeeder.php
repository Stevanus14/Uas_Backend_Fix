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
            'name' => 'Stevanus Tetuko Kristianto',
            'email' => '10167@students.uajy.ac.id',
            'password' => '$2b$10$cLi8hqE.3e0p1BXuQUtSI.06x55XyRk5CfwyABawEVP3CuJ7Msbm6',
            'alamat' => 'Surakarta',
            'no_telp' => '081254764903',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
