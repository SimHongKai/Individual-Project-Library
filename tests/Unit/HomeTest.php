<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use UsersTableSeeder;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Home View without authentication
     * 
     * @return void
     */
    public function test_home_view_no_auth(){

        // route to Home Page
        $response = $this->get('home');
        
        $response->assertStatus(200);

        $response->assertViewIs('home');
        $response->assertViewHasAll([
            'popularBooks',
            'newBooks', 
            'recentBooks',
        ]);
    }

    /**
     * Test Home View with authentication
     * 
     * @return void
     */
    public function test_home_view_auth(){

        $user = User::factory(User::class)->create();

        // route to Home Page
        $response = $this->actingAs($user)
                    ->get('home');
        
        $response->assertStatus(200);

        $response->assertViewIs('home');
        $response->assertViewHasAll([
            'popularBooks',
            'newBooks', 
            'recentBooks',
            'similarRecs'
        ]);
    }


    /**
     * Test Get Popular Books Function
     * 
     * @return void
     */
    public function test_get_popular_books(){
        
        $testController = new \App\Http\Controllers\HomeController;
        $response = $testController->getPopularBooks();

        $this->assertNotNull($response);
    }

        /**
     * Test Get Popular Books Function
     * 
     * @return void
     */
    public function test_get_recent_books(){
        
        $testController = new \App\Http\Controllers\HomeController;
        $response = $testController->getRecentBooks();

        $this->assertNotNull($response);
    }
}
