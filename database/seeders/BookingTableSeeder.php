<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class BookingTableSeeder extends Seeder
{
    /**
     * Seed Booking
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert([
            'booking_id' => 999999,
            'user_id' => 1,
            'ISBN' => 1234523876954,
            'material_no' => 3,
            'status' => 1,
            'expire_at' => date('Y-m-d', strtotime("+7 days")),
        ]);
    }
}
