<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class MaterialTableSeeder extends Seeder
{
    /**
     * Seed Book
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert([
            'ISBN' => 'TestISBN12345',
            'call_no' => 'Test call no',
            'status' => 1,
        ]);
    }
}
