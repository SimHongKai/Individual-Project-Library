<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

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
            'user_id' => 999999,
            'username' => 'TestUser',
            'email' => 'test@gmail.com',
            'password' => Hash::make('TestPassword'),
            'privilege' => 1
        ]);
    }
}
