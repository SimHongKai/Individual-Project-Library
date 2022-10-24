<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminPanelTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Admin Panel View as non-admin
     * 
     * @return void
     */
    public function test_admin_panel_admin_auth(){
        $user = User::factory(User::class)->create();

        // route to Weekly Leader Board Page
        $response = $this->actingAs($user)->get(route('admin_panel'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.admin');
    }

    /**
     * Test Admin Panel Redirect when no auth
     * 
     * @return void
     */
    public function test_admin_panel_no_auth(){

        // route to Weekly Leader Board Page
        $response = $this->from(route('home'))->get(route('admin_panel'));
        
        $response->assertStatus(302);

        $response->assertRedirect(route('home'));
    }

    /**
     * Test Admin Panel View redirect when no admin auth
     * 
     * @return void
     */
    public function test_admin_panel_no_admin_auth(){

        $user = User::factory(User::class)->create([
            'privilege' => 2,
        ]);
        // route to Weekly Leader Board Page
        $response = $this->actingAs($user)->get(route('admin_panel'));
        
        $response->assertStatus(302);

        $response->assertRedirect('');
    }
}
