<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class BorrowHistoryTableSeeder extends Seeder
{
    /**
     * Seed Book
     *
     * @return void
     */
    public function run()
    {
        DB::table('borrowhistory')->insert([
            'user_id' => 999999,
            'material_no' => 999999,
            'ISBN' => '1234567891011',
            'status'=> 1,
            'created_by' => 1,
        ]);
    }
}
