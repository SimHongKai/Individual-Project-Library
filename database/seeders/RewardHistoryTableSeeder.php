<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class RewardHistoryTableSeeder extends Seeder
{
    /**
     * Seed Book
     *
     * @return void
     */
    public function run()
    {
        DB::table('rewardHistory')->insert([
            'reward_history_id' => 999999,
            'user_id' => 1,
            'reward_id' => 999999,
            'name' => 'TestRewardName',
            'description' => 'TestRewardDesc',
            'points_required' => 0, 
            'status' => 1,
        ]);
    }
}
