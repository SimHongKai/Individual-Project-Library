<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Profile View 
     * 
     * @return void
     */
    public function test_profile_view(){
        $user = User::factory(User::class)->create();

        // route to Weekly Leader Board Page
        $response = $this->actingAs($user)->get(route('profile'));
        
        $response->assertStatus(200);

        $response->assertViewIs('bookmarks');
        $response->assertViewHasAll([
            'bookmarks',
            'user',
        ]);
    }

    /**
     * Test Profile Borrow History View 
     * 
     * @return void
     */
    public function test_profile_borrow_history_view(){
        $user = User::factory(User::class)->create();

        // route to Weekly Leader Board Page
        $response = $this->actingAs($user)->get(route('profile_borrows'));
        
        $response->assertStatus(200);

        $response->assertViewIs('borrowHistory');
        $response->assertViewHasAll([
            'borrowHistory',
            'user',
        ]);
    }

    /**
     * Test Profile Reward View 
     * 
     * @return void
     */
    public function test_profile_reward_history_view(){
        $user = User::factory(User::class)->create();

        // route to Weekly Leader Board Page
        $response = $this->actingAs($user)->get(route('profile_rewards'));
        
        $response->assertStatus(200);

        $response->assertViewIs('rewardHistory');
        $response->assertViewHasAll([
            'rewardHistory',
            'user',
        ]);
    }

    /**
     * Test Profile Booking View
     * 
     * @return void
     */
    public function test_profile_booking_history_view(){
        $user = User::factory(User::class)->create();

        // route to Weekly Leader Board Page
        $response = $this->actingAs($user)->get(route('profile_bookings'));
        
        $response->assertStatus(200);

        $response->assertViewIs('bookingHistory');
        $response->assertViewHasAll([
            'bookings',
            'user',
        ]);
    }

    /**
     * Test Profile View redirect when no auth
     * 
     * @return void
     */
    public function test_profile_no_auth(){

        // route to Leader Board Page
        $response = $this->get(route('profile'));
        
        $response->assertStatus(302);

        $response->assertRedirect('login');
    }

    /**
     * Test Claim Daily Points
     * 
     * @return void
     */
    public function test_claim_daily_points(){
        $user = User::factory(User::class)->create([
            'last_check_in' => date('Y-m-d', strtotime("-1 days")),
            'privilege' => 1,
        ]);

        // route to Weekly Leader Board Page
        $response = $this->from(route('profile'))->actingAs($user)->get(route('claim_daily'));
        
        $response->assertStatus(302);
        $response->assertRedirect(route('profile'));
        $this->assertEquals($user->total_points, 100);
        $this->assertEquals($user->weekly_points, 100);
        $this->assertEquals($user->current_points, 100);
    }

    /**
     * Test Claim Daily Points Fail
     * 
     * @return void
     */
    public function test_claim_daily_points_fail(){
        $user = User::factory(User::class)->create();

        // route to Weekly Leader Board Page
        $response = $this->from(route('profile'))->actingAs($user)->get(route('claim_daily'));
        
        $response->assertStatus(302);
        $response->assertRedirect(route('profile'));
        $this->assertEquals($user->total_points, 0);
        $this->assertEquals($user->weekly_points, 0);
        $this->assertEquals($user->current_points, 0);
    }

}
