<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name" => "Coder",
            "email" => "coder@gmail.com",
            "phone" => "09251009711",
            "password" => bcrypt("123123123")
        ]);
    }
}
