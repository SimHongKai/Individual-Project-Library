<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LeaderboardTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Leader Board View 
     * 
     * @return void
     */
    public function test_weekly_leaderboard_auth(){
        $user = User::factory(User::class)->create();

        // route to Weekly Leader Board Page
        $response = $this->actingAs($user)->get('weekly_leaderboard');
        
        $response->assertStatus(200);

        $response->assertViewIs('leaderboardWeekly');
        $response->assertViewHasAll([
            'users', 
            'topUsers',
            'pageNumber', 
            'position'
        ]);
    }

    /**
     * Test weekly Leader Board View redirect when no auth
     * 
     * @return void
     */
    public function test_weekly_leaderboard_no_auth(){

        // route to Weekly Leader Board Page
        $response = $this->get('weekly_leaderboard');
        
        $response->assertStatus(302);

        $response->assertRedirect('login');
    }

    /**
     * Test Total Leader Board View redirect when no auth
     * 
     * @return void
     */
    public function test_total_leaderboard_auth(){
        $user = User::factory(User::class)->create();

        // route to Leader Board Page
        $response = $this->actingAs($user)->get('leaderboard');
        
        $response->assertStatus(200);

        $response->assertViewIs('leaderboard');
        $response->assertViewHasAll([
            'users', 
            'topUsers',
            'pageNumber', 
            'position'
        ]);
    }

    /**
     * Test Total Leader Board View redirect when no auth
     * 
     * @return void
     */
    public function test_total_leaderboard_no_auth(){

        // route to Leader Board Page
        $response = $this->get('leaderboard');
        
        $response->assertStatus(302);

        $response->assertRedirect('login');
    }
}
