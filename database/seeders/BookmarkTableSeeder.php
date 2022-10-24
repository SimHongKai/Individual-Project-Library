<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class BookmarkTableSeeder extends Seeder
{
    /**
     * Seed Bookmark
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookmarks')->insert([
            'user_id' => 1,
            'ISBN' => 1234523876954,
        ]);
    }
}
