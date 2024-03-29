<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class RewardTableSeeder extends Seeder
{
    /**
     * Seed Book
     *
     * @return void
     */
    public function run()
    {
        DB::table('rewards')->insert([
            'reward_id' => 999999,
            'name' => 'TestRewardName',
            'description' => 'TestRewardDescription',
            'points_required' => 1000,
            'available_qty' => 1,
        ]);
    }
}
