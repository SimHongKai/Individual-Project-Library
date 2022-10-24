<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use BookmarkTableSeeder;
use BookTableSeeder;

class BookmarkTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test create bookmark
     * 
     * @return void
     */
    public function test_create_bookmark(){
        $this->seed(BookTableSeeder::class);
        $user = User::factory(User::class)->create([
            'user_id' => 999999,
        ]);

        // route to create bookmark
        $response = $this->actingAs($user)
                    ->post(route('add_bookmark'), [
                        'ISBN' => 'testISBN12345'
                    ]);

        $this->assertDatabaseHas('bookmarks', [
            'ISBN' => 'testISBN12345',
            'user_id' => $user->user_id,
        ]);
    }

    /**
     * Test delete bookmark
     * 
     * @return void
     */
    public function test_delete_bookmark(){
        
        $this->seed(BookmarkTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to delete bookmark
        $response = $this->actingAs($user)
                    ->post(route('delete_bookmark'), [
                        'ISBN' => 'testISBN12345'
                    ]);

        $this->assertTrue($response != null);
    }

}
