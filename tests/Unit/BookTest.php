<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use UsersTableSeeder;

class BookTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Catalog View
     * 
     * @return void
     */
    public function test_catalogue_view(){

        // route to Catalog Page
        $response = $this->get(route('catalog'));
        
        $response->assertStatus(200);

        $response->assertViewIs('catalog');
        $response->assertViewHas('books');
    }

    /**
     * Test Search Catalog View
     * 
     * @return void
     */
    public function test_search_catalogue_view(){

        // route to Catalog Search Page
        $response = $this->get(route('catalog_search'));
        
        $response->assertStatus(200);

        $response->assertViewIs('catalogSearch');
    }

    /**
     * Test Search Catalog Submit
     * 
     * @return void
     */
    public function test_search_catalogue(){

        // route to Catalog Search Page
        $response = $this->get(route('catalog_search_submit'));
        
        $response->assertStatus(200);

        $response->assertViewIs('catalog');
        $response->assertViewHas('books');
    }

    /**
     * Test Book Detail View
     * 
     * @return void
     */
    public function test_book_detail_view(){

        // route to Book Details Page
        $response = $this->get(route('book_details', [ 'ISBN'=> '1234523876954' ]));
        
        $response->assertStatus(200);

        $response->assertViewIs('bookDetails');
        $response->assertViewHasAll([
            'book', 
            'materials', 
            'recs', 
            'booking', 
            'bookingQueue'
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
