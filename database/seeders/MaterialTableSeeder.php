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
            'material_no' => 999999,
            'ISBN' => '1234567891011',
            'call_no' => 'TestCallNo',
            'status' => 1,
        ]);
    }
}
