<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RecordsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Borrow Records View 
     * 
     * @return void
     */
    public function test_borrow_records_view(){
        $user = User::factory(User::class)->create();

        // route to Borrow Records Page
        $response = $this->actingAs($user)->get(route('admin_borrow_records'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.record.borrowRecords');
        $response->assertViewHas('borrowHistory');
    }

    /**
     * Test Reward Records View 
     * 
     * @return void
     */
    public function test_reward_records_view(){
        $user = User::factory(User::class)->create();

        // route to Reward Records Page
        $response = $this->actingAs($user)->get(route('admin_reward_records'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.record.rewardRecords');
        $response->assertViewHas('rewardHistory');
    }

    /**
     * Test Unclaimed Records View 
     * 
     * @return void
     */
    public function test_unclaimed_reward_records_view(){
        $user = User::factory(User::class)->create();

        // route to Unclaimed Rewards Page
        $response = $this->actingAs($user)->get(route('admin_unclaimed_rewards'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.record.unclaimedRewardList');
        $response->assertViewHas('rewardHistory');
    }
}

