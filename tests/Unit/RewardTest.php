<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use RewardTableSeeder;

class RewardTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Reward View without authentication
     * 
     * @return void
     */
    public function test_reward_view_no_auth(){

        // route to Reward Page
        $response = $this->get('reward_shop');
        
        $response->assertStatus(302);

        $response->assertRedirect('login');
    }

    /**
     * Test Reward View with authentication
     * 
     * @return void
     */
    public function test_reward_view_auth(){

        $user = User::factory(User::class)->create();

        // route to Reward Page
        $response = $this->actingAs($user)
                    ->get(route('reward_shop'));
        
        $response->assertStatus(200);

        $response->assertViewIs('rewardRedemption');
        $response->assertViewHas('rewards');
    }

    /**
     * Test Redeem Reward Success
     * 
     * @return void
     */
    public function test_redeem_reward(){

        $this->seed(RewardTableSeeder::class);
        $user = User::factory(User::class)->create([
            'user_id' => 999999,
            'current_points' => 1000,
        ]);

        // route to Reward Page
        $response = $this->actingAs($user)
                    ->get(route('redeem_reward', [ 'reward_id'=> 1 ]));
        

        $this->assertEquals($user->current_points, 900);
        $response->assertStatus(302);
        $response->assertRedirect(route('reward_shop'));
    }

    /**
     * Test Redeem Reward Fail
     * 
     * @return void
     */
    public function test_redeem_reward_fail(){

        $this->seed(RewardTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Reward Page
        $response = $this->actingAs($user)
                    ->get(route('redeem_reward', [ 'reward_id'=> 1 ]));
        
        $this->assertEquals($user->current_points, 0);
        $response->assertStatus(302);
        $response->assertRedirect(route('reward_shop'));
    }

}
