<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class BookTableSeeder extends Seeder
{
    /**
     * Seed Book
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'ISBN' => '1234567891011',
            'title' => 'TestTitle',
            'description' => 'TestDesc',
            'author' => 'TestAuthor',
            'publication' => 'TestPublication',
            'publication_date'=> date("Y-m-d"),
            'price'=> 50,
            'language'=> '(EN) English',
            'total_qty' => 1,
            'available_qty' => 1,
            'access_level'=> 1,
        ]);
    }
}
