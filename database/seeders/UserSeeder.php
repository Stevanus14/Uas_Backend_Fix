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
            'name' => 'admin01',
            'email' => 'admin01@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => '$2b$10$c0W/Y0e7lBEwFgwODxpf6ussA1EPn6ihUs1MckXzIEC8uQRIjQJoG',
            'alamat' => 'admin01-alamat',
            'no_telp' => '0857913610000',
            'remember_token' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
